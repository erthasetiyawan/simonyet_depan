<?php

namespace App;
use Ez\Database as DB;
use Ez\View;
use Ez\Request;

/**
 * @author Ertha Dwi Setiyawan
 */
class AsetController extends Controller
{
    /**
     * summary
     */

    protected $breadcrumb = [];

    public function __construct()
    {
    	$this->db = (new DB);

        $this->activPage('aset');
    }

    public function getIndex()
    {
        $min = $this->toArray("select min(nilai_sewa) min_sewa from aset")['min_sewa'];

        $max = $this->toArray("select max(nilai_sewa) max_sewa from aset")['max_sewa'];

        $tarif = $this->pushArray("select * from tarif");

        View::render('App.view.aset.index', compact('min', 'max', 'tarif'));
    }

    public function ajaxGetJson()
    {
        $q = Request::query('q');
        $from = Request::query('from');
        $to = Request::query('to');
        $tarif = Request::query('tarif');

        $in_q = " 1=1 ";
        $in_nilai = " 1=1 ";
        $in_tarif = " 1=1 ";

        if(!empty($q)) $in_q = "a.nama like '%".$q."%'";
        if(!empty($from) || !empty($to)) $in_nilai = "a.nilai_sewa between " . $from . " and " . $to . "";
        if(!empty($tarif)) $in_tarif = "a.tarif in(".$tarif.")";

        $data = $this->pushArray("select a.*, t.urai urai_tarif from aset a, tarif t where a.tarif=t.id and $in_q and $in_nilai and $in_tarif");

       	die(json_encode([
       		"data" => $data
       	]));
    }

    public function getJson()
    {
    	$data = $this->db->table('aset a, tarif t')
    			->select('a.*, t.urai as urai_tarif')
    			->where("a.tarif", '=', 't.id')
    			->get();

       	die(json_encode([
       		"data" => $data
       	]));
    }

    public function getCart()
    {
    	$id = Request::query('id');
        
        $data = $this->db->table('aset a, tarif t')->where('a.id', '=', $id)->where('a.tarif', '=', 't.id')->select('a.*, t.urai as urai_tarif')->one();

        $tarif = $this->toArray("select * from tarif where id = " . $data['tarif'] . "");

        View::render('App.view.aset.cart', compact('data', 'tarif'));
    }

    public function ajaxPostSimpan()
    {   

        $post = Request::data();

        $kode = intval($post->kode);
        $tarif = intval($post->tarif);
        $id_user = intval(auth()->id);
        $token = str_replace(["\n","\r"], "", session('usertoken'));
        $tgl_mulai = date('Y-m-d', strtotime($post->tgl_mulai));
        $jam_mulai = date('H:i', strtotime($post->jam_mulai));
        $durasi = intval($post->durasi);
        $tgl_selesai = date('Y-m-d', strtotime($post->tgl_selesai));
        $jam_selesai = date('H:i', strtotime($post->jam_selesai));
        $keterangan = trim($post->keterangan);

        $aset = $this->toArray("select * from aset where id = " . $kode . "");

        $sewa = $this->pushArray("select * from sewa where id_aset = " . $aset['id'] . "");

        $cek_sewa = $this->pushArray("select * from sewa where id_pengguna = " . $id_user . " and status = 0");

        $total_harga_sewa = $durasi * $aset['nilai_sewa'];

        $datetime = [];
        $datetime_range = [];

        foreach ($sewa as $values) {

            /* Hitung Jam */

            $e_mulai = new \DateTime($values['tgl_mulai'] . ' ' . $values['jam_mulai']);
            $e_selesai = new \DateTime($values['tgl_selesai'] . ' ' . $values['jam_selesai']);
            $e_selesai = $e_selesai->modify('+1 minutes');

            $jam_interval = new \DateInterval('PT1M');
            $jamRange = new \DatePeriod($e_mulai, $jam_interval, $e_selesai);

            foreach ($jamRange as $j => $k) {
                
                array_push($datetime, $k->format('Y-m-d H:i'));

            }

            /* Hitung Tanggal Sewa Sekarang */

            $begins = new \DateTime($tgl_mulai . ' ' . $jam_mulai);
            $ends = new \DateTime($tgl_selesai . ' ' . $jam_selesai);
            $ends = $ends->modify( '+1 minutes' );

            $intervals = new \DateInterval('PT1M');
            $dateRanges = new \DatePeriod($begins, $intervals ,$ends);

            foreach ($dateRanges as $keys => $values) {
                
                array_push($datetime_range, $values->format('Y-m-d H:i'));

            }
            
        }

        foreach ($datetime_range as $r => $rq) {
            
            if (in_array($rq, $datetime)) {       

                die(json_encode([
                    "status"    => "gagal",
                    "pesan"     => "Aset ini sudah dipesan pada jam, tanggal tersebut!"
                ]));

            }

        }


        // Coba buat validasi lagi di backend nya ^-^

        $insert = $this->db->table('sewa')->insert([
            'id_pengguna' => $id_user,
            'id_aset' => $kode,
            'id_tarif' => $tarif,
            'token' => $token,
            'tgl_mulai' => $tgl_mulai,
            'jam_mulai' => $jam_mulai,
            'tgl_selesai' => $tgl_selesai,
            'jam_selesai' => $jam_selesai,
            'harga_sewa' => $aset['nilai_sewa'],
            'total_harga_sewa' => $total_harga_sewa,
            'keterangan' => $keterangan
        ]);

        if ($insert->run()) {
            
            die(json_encode([
                "status" => "sukses",
                "pesan" => "Pemesanan Aset berhasil!",
                "redirect" => url("app/aset/success?token=" . $token)
            ]));

        }else{

            die(json_encode([
                "status" => "gagal",
                "pesan" => "Pemesanan Aset Anda tidak dapat diproses!"
            ]));

        }

    }

    public function getSuccess()
    {
        View::render('App.view.aset.sukses');
    }

    public function ajaxPostPertarif()
    {

        $input = new \stdClass;
        $input->tarif = intval(Request::data()->tarif);

        if ($input->tarif === PER_JAM) {
            
            $input->lama_sewa = intval(Request::data()->durasi);
            $input->mulai = trim(Request::data()->jam_mulai);
            $input->tgl_mulai = date(Request::data()->tgl_mulai);

            if($input->lama_sewa === 0 || empty($input->mulai)){

                $jam_selesai = "";
                $tgl_selesai = "";

            }else{

                if (empty($input->tgl_mulai)) {
                    
                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' hours', strtotime($input->mulai)));

                }else{

                    $gabung = date($input->tgl_mulai) . ' ' . date($input->mulai);

                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' hours', strtotime($gabung)));

                }

                list($tgl_selesai,$jam_selesai) = explode(' ', $mulai);
            }

            die(json_encode([
                "jam_selesai" => $jam_selesai,
                "tgl_selesai" => $tgl_selesai
            ]));

        }elseif ($input->tarif === PER_HARI) {
            
            $input->lama_sewa = intval(Request::data()->durasi);
            $input->mulai = trim(Request::data()->jam_mulai);
            $input->tgl_mulai = date(Request::data()->tgl_mulai);

            if($input->lama_sewa === 0 || empty($input->mulai)){

                $jam_selesai = "";
                $tgl_selesai = "";

            }else{

                if (empty($input->tgl_mulai)) {
                    
                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' day', strtotime($input->mulai)));

                }else{

                    $gabung = date($input->tgl_mulai) . ' ' . date($input->mulai);

                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' day', strtotime($gabung)));

                }


                list($tgl_selesai,$jam_selesai) = explode(' ', $mulai);

            }

            die(json_encode([
                "jam_selesai" => $jam_selesai,
                "tgl_selesai" => $tgl_selesai
            ]));


        }elseif ($input->tarif === PER_BULAN) {

            $input->lama_sewa = intval(Request::data()->durasi);
            $input->mulai = trim(Request::data()->jam_mulai);
            $input->tgl_mulai = date(Request::data()->tgl_mulai);

            if($input->lama_sewa === 0 || empty($input->mulai)){

                $jam_selesai = "";
                $tgl_selesai = "";

            }else{

                if (empty($input->tgl_mulai)) {
                    
                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' month', strtotime($input->mulai)));

                }else{

                    $gabung = date($input->tgl_mulai) . ' ' . date($input->mulai);

                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' month', strtotime($gabung)));

                }


                list($tgl_selesai,$jam_selesai) = explode(' ', $mulai);

            }

            die(json_encode([
                "jam_selesai" => $jam_selesai,
                "tgl_selesai" => $tgl_selesai
            ]));


        }elseif ($input->tarif === PER_TAHUN) {
            
            $input->lama_sewa = intval(Request::data()->durasi);
            $input->mulai = trim(Request::data()->jam_mulai);
            $input->tgl_mulai = date(Request::data()->tgl_mulai);

            if($input->lama_sewa === 0 || empty($input->mulai)){

                $jam_selesai = "";
                $tgl_selesai = "";

            }else{

                if (empty($input->tgl_mulai)) {
                    
                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' year', strtotime($input->mulai)));

                }else{

                    $gabung = date($input->tgl_mulai) . ' ' . date($input->mulai);

                    $mulai = date('Y-m-d H:i', strtotime('+'.$input->lama_sewa.' year', strtotime($gabung)));

                }


                list($tgl_selesai,$jam_selesai) = explode(' ', $mulai);

            }

            die(json_encode([
                "jam_selesai" => $jam_selesai,
                "tgl_selesai" => $tgl_selesai
            ]));

        }

    }
}
<?php

namespace App;
use Ez\Database as DB;
use Ez\View;
use Ez\Request;

/**
 * @author Ertha Dwi Setiyawan
 */
class PenyewaController extends Controller
{
    /**
     * summary
     */

    protected $breadcrumb = [];

    public function __construct()
    {
    	$this->db = (new DB);

        $this->activPage('penyewa');
    }

    public function getIndex()
    {

        $result_data = "select s.*, p.nama,p.email,p.notelepon,a.nama nama_aset, t.urai tarif from sewa s join pengguna p on s.id_pengguna=p.id join aset a on a.id=s.id_aset join tarif t on t.id=s.id_tarif";

        $data = [
            'title' => 'Daftar Penyewa',
            'data' => $this->pushArray($result_data)
        ];

        View::render('App.view.penyewa.index', $data);
    }
}
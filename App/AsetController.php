<?php

namespace App;
use Ez\Database as DB;
use Ez\View;
use Ez\Request;

/**
 * summary
 */
class AsetController
{
    /**
     * summary
     */

    protected $breadcrumb = [];

    protected $db;

    public function __construct()
    {
    	$this->db = (new DB);
    }

    private function pushArray($query)
    {
        $data = [];

        $query = $this->db->query($query);

        while ($row = $this->db->assoc($query)) {
            array_push($data, $row);
        }

        return $data;
    }

    public function getIndex()
    {
        $min = $this->db->assoc($this->db->query("select min(nilai_sewa) min_sewa from aset"))['min_sewa'];

        $max = $this->db->assoc($this->db->query("select max(nilai_sewa) max_sewa from aset"))['max_sewa'];

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

        View::render('App.view.aset.cart', compact('data'));
    }
}
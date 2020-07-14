<?php

namespace App;
use Ez\Database as DB;
use Ez\Request;
use Ez\View;

/**
 * @author Ertha Dwi Setiyawan
 */

class DashboardController extends Controller
{
    
	public function __construct()
	{
	    $this->db = (new DB);
	}

	public function getIndex()
	{
		$result_data = "select s.*, p.nama,p.email,p.notelepon,a.nama nama_aset, t.urai tarif from sewa s 
						join pengguna p on s.id_pengguna=p.id join aset a on a.id=s.id_aset join tarif t on t.id=s.id_tarif
						where s.id_pengguna = " . auth()->id . "";
		// die($result_data);

        $data = [
            'title' => 'List Aset',
            'data' => $this->pushArray($result_data)
        ];

	    View::render('App.view.dashboard.index', $data);
	}

	public function getInvoice()
	{
		$id = Request::query('token');

		$result_data = "select s.*, p.nama,p.email,p.notelepon,a.nama nama_aset, t.urai tarif from sewa s 
						join pengguna p on s.id_pengguna=p.id join aset a on a.id=s.id_aset join tarif t on t.id=s.id_tarif
						where s.id_pengguna = " . auth()->id . " and s.id = " . $id . "";

		$data = [
			'sewa' => $this->pushArray($result_data)
		];

		View::render('App.view.dashboard.invoice', $data);
	}

}


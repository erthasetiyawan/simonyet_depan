<?php

namespace App\Admin;

use Ez\View;
use Ez\Request;
use Ez\Database as DB;
use App\BaseController;

class SewaController extends BaseController
{

	protected $pagename = 'Sewa';

	public function __construct()
	{

		parent::__construct();
		
		$this->auth('admin');

		$this->breadcrumb([
			'app/admin/sewa/index' => $this->pagename
		]);

		$this->activPage('sewa');
	}

	public function getIndex()
	{
		$sql_aset = "select s.*,
					(select nama from pengguna where id=s.id_pengguna) nama_pengguna,
					(select nama from aset where id=s.id_aset) nama_aset,
					(select urai from tarif where id=s.id_tarif) tarif
					from sewa s";

		$data = [
			'title' => 'Data Sewa',
			'data' => $this->pushArray($sql_aset)
		];

	    View::render('App.Admin.view.sewa.index', $data);
	}

	public function getApprove()
	{
	    $hapus = (new DB)
			->table('sewa')
			->where('id', Request::query('id'))
			->update([
				'status' => 1
			])
			->run();

		redirect('app/admin/sewa/index');

	}

	public function getUnapprove()
	{
	    $hapus = (new DB)
			->table('sewa')
			->where('id', Request::query('id'))
			->update([
				'status' => 0
			])
			->run();

		redirect('app/admin/sewa/index');

	}

}
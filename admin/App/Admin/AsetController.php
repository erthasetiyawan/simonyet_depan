<?php

namespace App\Admin;

use Ez\View;
use Ez\Request;
use Ez\Database as DB;
use App\BaseController;

class AsetController extends BaseController
{

	protected $pagename = 'Aset';

	public function __construct()
	{

		parent::__construct();
		
		$this->auth('admin');

		$this->breadcrumb([
			'app/admin/aset/index' => $this->pagename
		]);

		$this->activPage('aset');
	}

	public function getIndex()
	{
		$sql_aset = "select a.*,t.urai nama_tarif from aset a join tarif t on a.tarif=t.id";

		$data = [
			'title' => 'Data Aset',
			'data' => $this->pushArray($sql_aset)
		];

	    View::render('App.Admin.view.aset.index', $data);
	}

	public function getTambah()
	{
		$this->breadcrumb([
			'app/admin/aset/tambah' => 'Tambah',
		], $this->pagename);

		$data = [
			'tarif' => $this->pushArray("select * from tarif")
		];

	    View::render('App.Admin.view.aset.tambah', $data);
	}

	public function ajaxPostSimpan()
	{
	    $post = postRules([
			'nama' => 'string|required',
			'tarif' => 'numeric|required',
			'harga_sewa' => 'string|required',
			'gambar' => 'string|required',
			'deskripsi' => 'string|required',
		]);

		$insert = (new DB)->table('aset')->insert([
			'nama' => $post['data']['nama'],
			'deskripsi' => $post['data']['deskripsi'],
			'gambar' => $post['data']['gambar'],
			'tarif' => $post['data']['tarif'],
			'nilai_sewa' => str_replace(".","", $post['data']['harga_sewa']),
			'created_at' => date('Y-m-d H:i:s')
		]);

		if ($insert->run()) {

			die(json_encode([
				'status' => 'success',
				'flash' => 'Data berhasil disimpan',
				'redirect' => url('app/admin/aset/index'),
			]));

		} else {

			die(json_encode([
				'status' => 'error',
				'flash' => 'Data gagal disimpan',
			]));
		}
	}

	public function getEdit()
	{
	    $id = Request::query('id');
		
		$this->breadcrumb([
			'app/admin/aset/edit?id=' . $id => 'Ubah',
		], $this->pagename);

		$aset = (new DB)->table('aset')->select(
			'*'
		)->where('id', $id)->one();

		View::render('App.Admin.view.aset.edit', [
			'aset' => $aset,
			'level' => $this->level,
			'tarif' => $this->pushArray("select * from tarif")
		]);
	}

	public function ajaxPostUpdate()
	{
	    $post = postRules([
	    	'id' => 'integer|required',
			'nama' => 'string|required',
			'tarif' => 'numeric|required',
			'harga_sewa' => 'string|required',
			'gambar' => 'string|required',
			'deskripsi' => 'string|required',
		]);


		$update = (new DB)->table('aset')->update([
			'nama' => $post['data']['nama'],
			'deskripsi' => $post['data']['deskripsi'],
			'gambar' => $post['data']['gambar'],
			'tarif' => $post['data']['tarif'],
			'nilai_sewa' => str_replace(".","", $post['data']['harga_sewa']),
			'created_at' => date('Y-m-d H:i:s')
		])->where([
			'id' => $post['data']['id']
		]);

		if ($update->run()) {

			die(json_encode([
				'status' => 'success',
				'flash' => 'Data berhasil disimpan',
				'redirect' => url('app/admin/aset/index'),
			]));

		} else {

			die(json_encode([
				'status' => 'error',
				'flash' => 'Data gagal disimpan',
			]));
		}
	}

	public function getHapus()
	{
	    $hapus = (new DB)
			->table('aset')
			->where('id', Request::query('id'))
			->delete()
			->run();

		redirect('app/admin/aset/index');

	}

}
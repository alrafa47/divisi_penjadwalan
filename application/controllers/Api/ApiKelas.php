<?php

use chriskacerguis\RestServer\RestController;

require_once APPPATH . 'libraries/RestController.php';
require_once APPPATH . 'libraries/Format.php';
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */

//  nama class harus sama dengan nama file 
class ApiKelas extends RestController
{
	public function __construct()
	{
		parent::__construct();
		// untuk me-load model file Model_Kelas
		$this->load->model('Model_Kelas');
	}

	/* 
	* @description untuk membuat pemanggilan api dengan metode get
	*/
	public function index_get()
	{
		// ambil nilai idnya
		$id = $this->get('id');
		if ($id === null) {
			// kalau kosong artinya ambil semua data kelas
			$kelas = $this->Model_Kelas->getData();
		} else {
			$field = $this->get('field');
			// kalau id tidak kosong maka ambil data kelas berdasarkan idnya
			$kelas = $this->Model_Kelas->getData($id, $field);
		}
		// jika terdapat data kelas
		if ($kelas) {
			// akan keluar respon sukses
			// kemudian keluar data kelas
			$this->response([
				'status' => 'success',
				'data' => $kelas
			], RestController::HTTP_OK);
		} else {
			// akan keluar respon failed
			// kemudian keluar pesan user not found
			$this->response([
				'status' => 'failed',
				'message' => 'user not found!'
			], RestController::HTTP_NOT_FOUND);
		}
	}

	// /* 
	// * @description untuk membuat pemanggilan api dengan metode delete
	// */
	// public function index_delete()
	// {
	// 	// ambil id dari method delete
	// 	$id = $this->delete('id');
	// 	// kalau id kosong/ nulll
	// 	if ($id === null) {
	// 		// failed
	// 		$this->response([
	// 			'status' => 'failed',
	// 			'data' => 'provide an id'
	// 		], RestController::HTTP_BAD_REQUEST);
	// 	} else {
	// 		// kalau id tersedia
	// 		if ($this->Model_Kelas->delete($id)) {
	// 			// jika data terhapus
	// 			$this->response([
	// 				'status' => 'success',
	// 				'data' => 'data deleted'
	// 			], RestController::HTTP_OK);
	// 		} else {
	// 			// jika tidak ada data yg terhapus
	// 			$this->response([
	// 				'status' => 'failed',
	// 				'data' => 'no data was deleted'
	// 			], RestController::HTTP_NOT_FOUND);
	// 		}
	// 	}
	// }

	// /* 
	// * @description untuk membuat pemanggilan api dengan metode post
	// * tujuan untuk create melalui api
	// */
	// public function index_post()
	// {
	// 	// data yng ingin dibuat
	// 	$data = [
	// 		// "nama field dalam database" => $this->post('name'),
	// 		"id" => $this->post('id'),
	// 		"nama" => $this->post('nama'),
	// 		"nrp" => $this->post('nrp'),
	// 		"email" => $this->post('email'),
	// 		"jurusan" => $this->post('jurusan'),
	// 	];
	// 	// cek apakah ada data yang tersimpan 
	// 	if ($this->Model_Kelas->addData($data)) {
	// 		// jika ada kirim respon berikut
	// 		$this->response(
	// 			[
	// 				'status' => true,
	// 				'message' => "data " . $this->post('id') . " Added"
	// 			],
	// 			RestController::HTTP_CREATED
	// 		);
	// 	} else {
	// 		// jika tidak ada kirim respon berikut
	// 		$this->response([
	// 			'status' => 'failed',
	// 			'data' => 'no data was Added'
	// 		], RestController::HTTP_NOT_FOUND);
	// 	}
	// }

	// /* 
	// * @description untuk membuat pemanggilan api dengan metode post
	// * tujuan untuk update melalui api
	// */
	// public function index_put()
	// {
	// 	// ambil id dengan method put
	// 	$id = $this->put('id');
	// 	// data yng ingin dibuat
	// 	$data = [
	// 		// "nama field dalam database" => $this->post('name'),
	// 		"nama" => $this->put('nama'),
	// 		"nrp" => $this->put('nrp'),
	// 		"email" => $this->put('email'),
	// 		"jurusan" => $this->put('jurusan'),
	// 	];
	// 	// cek apakah ada data yang dirubah
	// 	if ($this->Model_Kelas->updateData($id, $data)) {
	// 		// jika ada data
	// 		$this->response(
	// 			[
	// 				'status' => true,
	// 				'message' => "data " . $this->put('id') . " Updated"
	// 			],
	// 			RestController::HTTP_CREATED
	// 		);
	// 	} else {
	// 		// jika tidak
	// 		$this->response([
	// 			'status' => 'failed',
	// 			'data' => 'no data was Updated'
	// 		], RestController::HTTP_NOT_FOUND);
	// 	}
	// }
}
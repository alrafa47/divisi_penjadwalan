<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_Guru extends CI_Model
{
    private $_client;
    public function __construct()
    {
        $this->_client = new Client([
            // url yang dituju
            'base_uri' => 'http://localhost/Kurikulum/Api/ApiGuru',
            [
                'auth' => ['admin' => '1234']
            ]
        ]);
    }

    public function getData($id = null)
    {
        if ($id == null) {
            $response = $this->_client->request(
                'GET',
                'ApiGuru'
            );
            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'];
        } else {
            $response = $this->_client->request(
                'GET',
                'ApiGuru',
                [
                    'query' => [
                        'id' => $id
                    ]
                ]
            );
            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'];
        }
    }

    /* 
    * func untuk menambah mahasiswa menggunakan API
    */

    public function delete($id)
    {
        $response = $this->_client->request(
            'DELETE',
            'ApiGuru',
            [
                'form_params' => ['id' => $id]
            ]
        );
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function create()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];
        $response = $this->_client->request(
            'POST',
            'ApiGuru',
            [
                'form_params' => $data
            ]
        );
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function update()
    {
        $data = [
            "id" => $this->input->post('id', true),
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];
        $response = $this->_client->request(
            'PUT',
            'ApiGuru',
            [
                'form_params' => $data
            ]
        );
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}

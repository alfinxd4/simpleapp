<?php
defined('BASEPATH') or exit('No direct script access allowed');
// mahasiswa model
class Mod_regist extends CI_Model
{
  // add new data to database
  public function add($data)
  {
    $data['nama'] = $this->input->post('nama');
    $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
    $data['no_tlp'] = $this->input->post('no_tlp');
    $data['email'] = $this->input->post('email');
    $data['alamat'] = $this->input->post('alamat');
    $data['password'] = $this->input->post('password');
    $data['password'] = md5($data['password']);
    $data['is_active'] = 0;
    $data['created'] = time();
    $data['foto'] = $data['foto'];

    $this->db->insert('account', $data);
  }
}

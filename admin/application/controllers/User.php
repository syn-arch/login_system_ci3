<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('user_m');
	}

	public function index()
	{
		$data['judul'] = "Data user";
		$data['user'] = $this->user_m->get_user();

		$this->load->view('template/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function tambah()
	{
		$valid = $this->form_validation;

		$valid->set_rules('id_user', 'id_user', 'required');

		if ($valid->run()) {
			$this->user_m->insert($this->input->post());
			$this->session->set_flashdata('message', 'Berhasil Ditambahkan');
			redirect('user','refresh');
		}

		$data['judul'] = "Tambah Data";
		$data['user'] = $this->user_m->get_user();

		$this->load->view('template/header', $data);
		$this->load->view('user/tambah', $data);
		$this->load->view('template/footer', $data);
	}

	public function ubah($id)
	{
		$valid = $this->form_validation;

		$valid->set_rules('id_user', 'id_user', 'required');

		if ($valid->run()) {
			$this->user_m->update($this->input->post());
			$this->session->set_flashdata('message', 'Berhasil Diubah');
			redirect('user','refresh');
		}

		$data['judul'] = "Ubah Data";
		$data['user'] = $this->user_m->get_user($id);

		$this->load->view('template/header', $data);
		$this->load->view('user/ubah', $data);
		$this->load->view('template/footer', $data);
	}

	public function hapus($id)
	{
		$this->db->delete('user', ['id_user' => $id]);
		$this->session->set_flashdata('message', 'Berhasil Dihapus');
		redirect('user','refresh');
	}
}

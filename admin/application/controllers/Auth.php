<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('id_user') != '') {
			redirect('user','refresh');
		}

		$valid = $this->form_validation;

		$valid->set_rules('email', 'email', 'required');
		$valid->set_rules('password', 'password', 'required');

		if ($valid->run()) {
			$post = $this->input->post();

			$this->db->where('email', $post['email']);
			$user = $this->db->get('user')->row_array();

			if ($user) {
				if (password_verify($post['password'], $user['password'])) {

					$array = array(
						'id_user' => $user['id_user'],
						'nama' => $user['nama'],
						'ip_address' => $user['ip_address']
					);
					
					$this->session->set_userdata( $array );

					$this->session->set_flashdata('success', 'Login Berhasil');
					redirect('user','refresh');
					
				}else{
					$this->session->set_flashdata('error', 'Password anda salah');
					redirect(base_url(),'refresh');
				}
			}else{
				$this->session->set_flashdata('error', 'Email tidak ditemukan');
				redirect(base_url(),'refresh');
			}

		}

		$this->load->view('auth/index');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth','refresh');
	}
}

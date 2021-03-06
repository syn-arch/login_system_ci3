<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function auth_user()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		
		$post = $this->input->post();

		if (!$post) {
			header('Content-Type: application/json');

			$response = [
				'error' => false,
				'message' => 'ERROR'
			];
			echo json_encode($response);
			die;	
		}

		$this->db->where('email', $post['email']);
		$user = $this->db->get('user')->row_array();

		if ($user) {
			if (password_verify($post['password'], $user['password'])) {

				header('Content-Type: application/json');

				$response = [
					'error' => false,
					'message' => 'Email dan password cocok'
				];

				echo json_encode($response);
				
			}else{
				header('Content-Type: application/json');

				$response = [
					'error' => true,
					'message' => 'Password salah'
				];

				echo json_encode($response);
			}
		}else{
			header('Content-Type: application/json');

			$response = [
				'error' => true,
				'message' => 'Email tidak ditemukan'
			];

			echo json_encode($response);
		}
	}

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

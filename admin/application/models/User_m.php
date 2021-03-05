<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_m extends CI_Model {

	public function get_user($id = '')
	{
		if ($id == '') {
			return $this->db->get('user')->result_array();
		}else{
			return $this->db->get_where('user', ['id_user' => $id])->row_array();
		}
	}	

	public function insert($post)
	{
		$this->db->insert('user', [
			'id_user' => $post['id_user'],
			'email' => $post['email'],
			'ip_address' => $post['ip_address'],
			'password' => password_hash($post['password'], PASSWORD_DEFAULT)
		]);
	}

	public function update($post)
	{
		$data =  [
			'email' => $post['email'],
			'ip_address' => $post['ip_address'],
		];

		if ($post['password'] != '') {
			$data['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
		}

		$this->db->where('id_user', $post['id_user']);
		$this->db->update('user', $data);
	}

}

/* End of file user_m.php */
/* Location: ./application/models/user_m.php */ ?>
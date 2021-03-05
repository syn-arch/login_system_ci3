<?php

function cek_login()
{
	$ci =& get_instance();
	if (!$ci->session->userdata('id_user')) {
		$ci->session->set_flashdata('error', 'Anda belum login');
		redirect('auth','refresh');
	}
}

function id($table, $id)
{
	$ci =& get_instance();
				$ci->db->order_by($id, 'Desc');
	$last_id = $ci->db->get($table)->row_array();
	$new_id = $last_id[$id] + 1;
	return $new_id;
}
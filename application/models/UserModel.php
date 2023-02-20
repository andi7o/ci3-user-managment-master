<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

//	public function get_users($per_page, $offset)
//	{
//		$this->db->limit($per_page, $offset);
//		$query = $this->db->get('users');
//		return $query->result();
//	}
	public function get_users($limit, $offset) {
		echo "limit = $limit<br>";
		echo "offset = $offset<br>";
		$query = $this->db->get('users', $limit, $offset);
		var_dump($query->result());
		return $query->result();
	}

	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	public function createUser($data)
	{
		return $this->db->insert('users', $data);
		$lastId = $this->db->insert_id(); /* get last inserted id */

	}

	public function getUserByName($name)
	{
		$query = $this->db->get_where('users', array('name' => $name));
		return $query->row_array();
	}

	public function getUserByEmail($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->row_array();
	}

	public function updateUser($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}


	public function deleteUser($id)
	{
		$this->db->delete('users', ['id' => $id]);
	}

	protected function before_insert()
	{
		date_default_timezone_set('CET');
		$this->created_at = date('d.m.Y');

	}
}

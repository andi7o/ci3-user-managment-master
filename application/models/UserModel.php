<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_users($limit, $page_number, $sort_by, $sort_order, $search)
	{
		$offset = ($page_number - 1) * $limit;
		$this->db->limit($limit, $offset);
		if($search != ''){
			$this->db->like('name', $search);
			$this->db->or_like('email', $search);
		}
		$data = $this->db->get('users')->result();

		if(isset($sort_by))
		usort($data, function($a, $b) use ($sort_by, $sort_order) {
			$a = (array) $a;
			$b = (array) $b;
			if($sort_order == 'asc')
				return strcmp($a[$sort_by], $b[$sort_by]);
			else
				return strcmp($a[$sort_by], $b[$sort_by]) * -1;

		});
		return $data;
	}

	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	public function createUser($data)
	{
		return $this->db->insert('users', $data);
//		$lastId = $this->db->insert_id(); /* get last inserted id */

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
	public function getrecordCount($search = '') {

		$this->db->select('count(*) as allcount');
		$this->db->from('users');

		if($search != ''){
			$this->db->like('name', $search);
			$this->db->or_like('email', $search);
		}

		$query = $this->db->get();
		$result = $query->result_array();

		return $result[0]['allcount'];
	}

}

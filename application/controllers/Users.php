<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		$this->load->library('session');
		$this->load->library('pagination');
	}

	// in the controller

	public function index()
	{



		$per_page = $this->input->get('per_page') ?? 4;
		$per_page = ($this->input->post('per_page')) ? $this->input->post('per_page') : $per_page;
		$sort_by = $this->input->get('sort_by') ?? 'id';
		$sort_order = $this->input->get('sort_order') ?? 'asc';

        $search_text = $this->input->post('search');

		$total_rows = $this->db->get('users')->num_rows();
		$total_pages = ceil($total_rows / $per_page);
		$current_page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$start_page = max($current_page - 2, 1);
		$end_page = min($current_page + 2, $total_pages);

		// Pass the sorting parameters to the get_users method
		$offset = ($current_page - 1) * $per_page;
		$users = $this->UserModel->get_users($per_page, $current_page, $sort_by, $sort_order,$search_text, $offset);
		$data['search'] = $search_text;
		$data['current_page'] = $current_page;
		$data['total_pages'] = $total_pages;
		$data['start_page'] = $start_page;
		$data['end_page'] = $end_page;
		$data['users'] = $users;
		$data['per_page'] = $per_page;
		$data['total_rows'] = $total_rows;
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->view('users', $data);
	}

	public function create()
	{
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);


		$this->load->view('createuser', ['csrf' => $csrf]);
	}


	public function edit($id)
	{
		$user = $this->UserModel->get_user_by_id($id);


		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$this->load->view('edituser', ['user' => $user, 'csrf' => $csrf]);
	}


	public function createUser()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|is_unique[users.name]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('createuser');
		} else {
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
			);
			$this->UserModel->createUser($data);
			$this->session->set_flashdata('success', 'User created successfully.');
			redirect('/users');
		}
	}


	public function deleteUser($id)
	{
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$this->UserModel->deleteUser($id, ['csrf' => $csrf]);

		redirect('users/');

	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email')
		);


		$this->UserModel->updateUser($id, $data);

		$this->session->set_flashdata('success', 'User updated successfully.');
		redirect('/users');
	}
}

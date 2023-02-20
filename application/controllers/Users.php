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


	public function index()
	{
		$per_page = $this->input->get('per_page');

		if ($per_page) {
			$this->session->set_userdata('per_page', $per_page);
		}
		if ($this->session->userdata('per_page')) {
			$per_page = $this->session->userdata('per_page');
		} else {
// Postavljamo zadanu vrijednost ako vrijednost per_page nije postavljena u sesiji
			$per_page = 4;
		}

// Dobivamo vrijednost pomaka iz URL segmenta
		$offset = $this->uri->segment(3);

		// Configure pagination settings
		$config['base_url'] = 'http://ci3-user-managment-system.test/users/index';
		$config['per_page'] = $per_page;
		$config['num_links'] = 3;
		$config['total_rows'] = $this->db->get('users')->num_rows();

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		// Initialize pagination library with configuration settings
		$this->pagination->initialize($config);

		// Get the users data with limit and offset using the model
		$data['users'] = $this->UserModel->get_users($per_page, $offset);

		$data['per_page'] = $per_page;
		$data['total_rows'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();

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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('homepage');
	}
	public function signup()
	{
		$this->load->view('signup');
	}
	public function signin()
	{
		$this->load->view('signin');
	}

	public function inserted()
	{
		$this->load->view('inserted');
	}

	public function register_user()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('f_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('l_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('psw', 'Password', 'required');
		$this->form_validation->set_rules('psw2', 'Password Confirmation', 'required|matches[psw]');

		if ($this->form_validation->run() == TRUE)
		{
			//if no error
			$this->load->model('main_model');
			$data = array(
				'Email' => $this->input->post('email'),
				'First_Name' => $this->input->post('f_name'),
				'Last_Name' => $this->input->post('l_name'),
				'Password' => password_hash($this->input->post('psw'), PASSWORD_DEFAULT)
			);
			$this->main_model->insert_data($data);

			redirect(base_url() . 'home/inserted');

		}
		else
		{
			//if there is an error
			$this->signup();
		}
	}

	public function login_user()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('psw', 'Password', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			//if no error
			echo "Success";
		}
		else
		{
			//if there is an error
			$this->signin();
		}
	}
}

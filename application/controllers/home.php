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

	//show sign up view
	public function signup()
	{
		$this->load->view('signup');
	}

	//show sign in view
	public function signin()
	{
		$this->load->view('signin');
	}

	//show data inserted
	public function inserted()
	{
		if($this->session->userdata('email') != '')
		{
			$this->load->model('main_model');

			$result['data']=$this->main_model->fetch_records();
			$this->load->view('inserted', $result);
		}else
		{
			redirect(base_url() . 'home/signin');
		}
	}

	//register new user
	public function register_user()
	{
		$this->load->library('form_validation');
		$this->load->library('session');
		// $this->load->library('encryption');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('f_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('l_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('psw', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('psw2', 'Password Confirmation', 'required|matches[psw]');

		if ($this->form_validation->run() == TRUE)
		{
			//if no error insert to database
			$this->load->model('main_model');

			//encript password
			// $verification_key = md5(rand());
			$encrypted_password = md5($this->input->post('psw'));
			
			$data = array(
				'Email' => $this->input->post('email'),
				'First_Name' => $this->input->post('f_name'),
				'Last_Name' => $this->input->post('l_name'),
				'Password' => $encrypted_password
			);

			//check if the email is already registerd
				
				//insert data to database
				$this->main_model->insert_data($data);

				//send email to the registerd user
				$from_email = 'eleazarsimba3000@gmail.com';
				$subject = "Account creation";
				$message = "
					<p>Hi ".$this->input->post('f_name')."</p>
					<p>This is email your account creation. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
					<p>Thanks,</p>
					";

				$this->load->library('email');

				// $this->email->set_newline("\r\n");
				$this->email->from($from_email, 'Eleazar');
				$this->email->to($this->input->post('email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if($this->email->send())
				{
					$this->session->set_flashdata('message', 'Email send');
					$session_data = array('email' => $this->input->post('email'));
					$this->session->set_userdata($session_data);
					//redirect to  homepage
					redirect(base_url() . 'home/inserted');
				}
				else{
					$this->session->set_flashdata('message', 'Email send fail');
					redirect(base_url() . 'home/signup');
				}
				
			// }
		}
		else
		{
			//if there is an error
			$this->session->set_flashdata('error', 'Error');
			$this->signup();
		}
	}

	//login an exiting user
	public function login_user()
	{
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('psw', 'Password', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			//if no error
			$email = $this->input->post('email');
			$password = md5($this->input->post('psw'));

			$this->load->model('main_model');
			//if login is a success
			if($this->main_model->loginhere($email, $password))
			{
				$session_data = array('email' => $email);
				$this->session->set_userdata($session_data);
				//redirect to a page after login
				redirect(base_url() . 'home/inserted');
			}
			else{
				//if error in login
				$this->session->set_flashdata('error', 'Invalid login details');
				redirect(base_url() . 'home/signin');
			}
		}
		else
		{
			//if there is an error
			$this->signin();
		}
	}

	//logout a user
	public function logout()
	{
		$this->session->unset_userdata('email');
		redirect(base_url() . 'home/signin');
	}

	/*Delete Record*/
	public function deletedata()
	{
		$email=$this->input->get('Email');
		$this->load->model('main_model');
		$response=$this->main_model->deleterecords($email);
		if($response==true){
			echo "Data deleted successfully !";
			$this->inserted();
		}
		else{
			echo "Error !";
		}
	}

	// check email availability 
    public function check_email_avalibility()  
      {  
           if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("main_model");  
                if($this->main_model->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger" ><span class="glyphicon glyphicon-remove"></span> Email is already registered</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';  
                }  
           }  
      }  

	//show send email view
	public function send_email()
	{
		$this->load->view('send_email');
	}

	//consume email api
	public function consume_email()
	{
		$this->load->view('send-mail-api');
	}

}

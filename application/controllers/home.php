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
			$encrypted_password = md5($this->input->post('psw'));
			
			$data = array(
				'Email' => $this->input->post('email'),
				'First_Name' => $this->input->post('f_name'),
				'Last_Name' => $this->input->post('l_name'),
				'Password' => $encrypted_password
			);

			//check if the email is already registerd
			if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
			{  
				$this->session->set_flashdata('message', 'Invalid email');
				$this->signup();
			}  
			else  
			{  
				 $this->load->model("main_model");  
				 if($this->main_model->is_email_available($_POST["email"]))  
				 {  
					  $this->session->set_flashdata('message', 'Email is already registered');
					  $this->signup();  
				 }  
				 else  
				 {  
					  //insert data to database
						$this->main_model->insert_data($data);
						$this->send_email_api();

						$session_data = array('email' => $this->input->post('email'));
						$this->session->set_userdata($session_data);

						//redirect to  homepage
						redirect(base_url() . 'home/inserted');

						//send email to the registerd user
						// $from_email = 'eleazarsimba3000@gmail.com';
						// $subject = "Account creation";
						// $message = "
						// 	<p>Hi ".$this->input->post('f_name')."</p>
						// 	<p>This is email your account creation. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
						// 	<p>Thanks,</p>
						// 	";

						// $this->load->library('email');

						// // $this->email->set_newline("\r\n");
						// $this->email->from($from_email, 'Eleazar');
						// $this->email->to($this->input->post('email'));
						// $this->email->subject($subject);
						// $this->email->message($message);
						// $this->send_email_api();
						// if($this->email->send())
						// {
						// 	$this->session->set_flashdata('message', 'Email send');
							// $session_data = array('email' => $this->input->post('email'));
							// $this->session->set_userdata($session_data);
							//redirect to  homepage
							// redirect(base_url() . 'home/inserted');
						// }
						// else{
						// 	$this->session->set_flashdata('message', 'Email send fail');
						// 	redirect(base_url() . 'home/signup');
						// }  
				 }  
			}				
		}
		else
		{
			//if there is an error
			$this->signup();
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

	//show sign in view
	public function signin()
	{
		$this->load->view('signin');
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
			//encrypt password
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
			//if there is an error in form validation
			$this->signin();
		}
	}

	//logout a user
	public function logout()
	{
		$this->session->unset_userdata('email');
		redirect(base_url() . 'home/signin');
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

	//show send email view
	public function send_email()
	{
		$this->load->view('send_email');
	}

	//consume email api
	public function send_email_api()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == TRUE)
		{			
			$data = array(
				'email' => $this->input->post('email')
			);

			$data_to_send = json_encode($data);

			$url = 'https://send-email-for-ofisho-app.herokuapp.com/';
			$curl = curl_init();
			
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, ['content-type: application/json']);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_to_send);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// If there is no SSL Certificate

			$result = curl_exec($curl);
			$err = curl_error($curl);
			if($err) {
				echo 'Curl Error: ' . $err;
			} else {
				echo 'Message send';
			}
			curl_close($curl);
		}
		else
		{
			//if there is an error
			$this->send_email();
		}
	}


	//consume news api
	// public function get_news()
	// {
	// 		$url = 'http://api.mediastack.com/v1/news?access_key=8137b743c25881df6500548cf5d2622d&categories=sports&languages=en';
	// 		$curl = curl_init();
			
	// 		curl_setopt($curl, CURLOPT_URL, $url);
	// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// If there is no SSL Certificate

	// 		$res = curl_exec($curl);
	// 		$sports_news = json_decode($res, true);
	// 		$this->load->view('get-sports-news', $sports_news);

	// 		curl_close($curl);

			// $i=1;
			// 	foreach((array) $res as $row)
			// 	{
			// 		  echo "<tr>";
			// 		  echo "<td>".$i."</td>";
			// 		  echo "<td>".$row->title."</td>";
			// 		  echo "<td>".$row->title."</td>";
			// 		  echo "<td>".$row->title."</td>";
			// 		  echo "<td>".$row->title."</td>";
			// 		  echo "</tr>";
			// 		  $i++;
			// 	}
			// $output = '';

			// if(count($sports_news) > 0)
			// {
			// 	foreach($sports_news as $row)  
			// 	{  
			// 			$output .= '
			// 			<tr>
			// 				<td>'.$row->title.'</td>
			// 				<td>'.$row->title.'</td>
			// 				<td>'.$row->title.'</td>
			// 				<td>'.$row->title.'</td>
			// 			</tr>
			// 			'; 
			// 	} 
			// }else
			// {
			// 	$output .= '
			// 			<tr>
			// 				<td colspan="4" align="center">No data found</td>
			// 			</tr>
			// 			';
			// }
			// echo  $sports_news;
	// }

	public function get_news()
	{
		$this->load->view('get-sports-news');
		
	}

}

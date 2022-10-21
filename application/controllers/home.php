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
		$this->load->library('encryption');

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
			// $encrypted_password = md5($this->input->post('psw'));
			$encrypted_password = $this->encryption->encrypt($this->input->post('psw'));
			
			$data = array(
				'Email' => $this->input->post('email'),
				'First_Name' => $this->input->post('f_name'),
				'Last_Name' => $this->input->post('l_name'),
				'Password' => $encrypted_password
			);

			//check if the email is already registerd
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

	//show sign in view
	public function tests()
	{
		$plain_text = 'a84828cb7a1aaf37b09ee0e13b575c386502c115784e9b54743b3b89249f6dda7737df6a41f8bd872d0500141c67d02b09dbf9aa9c8eaceb63af5e53e2d06d48RsPcpM3pdkYqfKurGpjzZM0tnunerHmEomSLLpL5jE0';
		$ciphertext = $this->encryption->decrypt($plain_text);

		// Outputs: This is a plain-text message!
		// echo $this->encryption->encrypt($plain_text);
		echo $ciphertext;
	}


	//login an exiting user
	public function login_user()
	{
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('encryption');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('psw', 'Password', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			//if no error
			$email = $this->input->post('email');
			//decrypt password
			// $password = md5($this->input->post('psw'));
			$password = $this->input->post('psw');


			$this->load->model('main_model');
			$result = $this->main_model->loginhere($email, $password);

			//if login is a success
			if($result == '')
			{
				//redirect to a page after login
				redirect(base_url() . 'home/inserted');
				// $this->inserted();
			}
			else{
				//if error in login
				$this->session->set_flashdata('error', $result);
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
			if($this->session->userdata('email') == $email){
				$this->session->unset_userdata('email');
			}
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


	//consume news api  nb didn't work
	public function news()
	{
			$url = 'http://api.mediastack.com/v1/news?access_key=8137b743c25881df6500548cf5d2622d&categories=sports&languages=en';
			$curl = curl_init();
			
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// If there is no SSL Certificate

			$res = curl_exec($curl);
			
			curl_close($curl);
			
			$sports_news['sports'] = json_decode($res, true);
			$this->load->view('news', $sports_news);

			print_r($sports_news['sports']['data']);
	}

	//show get sports news view
	public function get_news()
	{
		$this->load->view('get-sports-news');
		
	}
	//show fetched data with ajax
	public function fetched()
	{
		$this->load->model('main_model');

		$data=$this->main_model->fetch_data();
		$i=1;
			foreach($data as $row)
			{
					echo "<tr>";
					echo "<td>".$row->Email."</td>";
					echo "<td>".$row->First_Name."</td>";
					echo "<td>".$row->Last_Name."</td>";
					echo "<td><a href='updatedata?Email=".$row->Email."'>Update</a></td>";

					echo "</tr>";
					$i++;
			}
	}

	/*Update data*/
	public function updatedata()
	{
		$email=$this->input->get('Email');
		$this->load->model('main_model');

		$result['data']=$this->main_model->displayuserByEmail($email);
		$this->load->view('update_data',$result);

		if($this->input->post('update'))
		{
			$first_name=$this->input->post('f_name');
			$last_name=$this->input->post('l_name');
			
			$this->main_model->updaterecords($first_name,$last_name,$email);
			echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Record updated successfully !</label>'; 
			echo "<script language=\"javascript\">
				setTimeout(function(){window.location.href='inserted'}, 1000);
			</script>";
		}
	}

	//show get delete multiple view
	public function deletemultiple()
	{
		$this->load->model('main_model');

		$res['data']=$this->main_model->fetch_records();
		$this->load->view('deletemultiple', $res);
		
	}

	//delete multiple items nb didn't work
	public function delete_multiple()
	{
		$this->load->library('session');
		if(isset($_POST['delete_all']))
		{
			if(!empty($this->input->post('checkbox_value')))
			{
				$checkuser = $this->input->post('checkbox_value');
				$checked_list = [];
				foreach($checkuser as $row){
					array_push($checked_list, $row);
				}
				print_r($checked_list[0]);
				$this->load->model('main_model');
				$this->main_model->deletemultiple($checked_list);

				$this->session->set_flashdata('success', 'Records deleted');
				redirect(base_url() . 'home/deletemultiple');
			}
			else
			{
				$this->session->set_flashdata('error', 'Select one or multiple elements');
				redirect(base_url() . 'home/deletemultiple');

			}
		}
	}

	//show gallery view
	public function gallery()
	{
		$this->load->view('galler');
	}

	//upload an image
	public function upload_toGaller()
	{
		if(isset($_FILES["image_file"]["name"]))  
           {  
                $config['upload_path'] = './assets/';  
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('image_file'))  
                {  
                     echo $this->upload->display_errors();  
                }  
                else  
                {  
                     $data = $this->upload->data();  
                     echo '<img src="'.base_url().'assets/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
                }  
           }  
	}

}

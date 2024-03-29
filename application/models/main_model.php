<?php 
    class Main_model extends CI_Model
    {
        //insert data into table allusers
        function insert_data($data)
        {
            $this->db->insert('allusers', $data);
        }

        //fetch data from the database
        function fetch_records()
        {
            $query=$this->db->get("allusers");
            return $query;
        }

         //fetch data
         function fetch_data()
         {
             $query=$this->db->get("allusers");
             return $query->result();
         }
    
        //delete user by email
        function deleterecords($email)
        {
            $this->db->where("Email", $email);
            $this->db->delete("allusers");
            return true;
        }

        //login a user
        function loginhere($email, $password)
        {
            $this->db->where("Email", $email);
            // $this->db->where("Password", $password);
            $query = $this->db->get("allusers");

            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                {
                  $this->load->library('session');
                  $this->load->library('encryption');

                  $store_password = $this->encryption->decrypt($row->Password);
                  
                  if($password == $store_password)
                  {
                    $this->session->set_userdata('email', $row->Email);
                  }
                  else
                  {
                    return 'Wrong password';
                  } 
                }
            }
            else{
                return 'Wrong Email Address';
            }
        }

        //check email availability
        function is_email_available($email)  
        {  
            $this->db->where('Email', $email);  
            $query = $this->db->get("allusers");  
            if($query->num_rows() > 0)  
            {  
                    return true;  
            }  
            else  
            {  
                    return false;  
            }  
        }  

        //display user by email
        function displayuserByEmail($email)
        {
            $query=$this->db->query("select * from allusers where Email='".$email."'");
            return $query->result();
        }

        /*Update*/
        function updaterecords($first_name,$last_name,$email)
        {
            $query=$this->db->query("update allusers SET First_Name='$first_name',Last_Name='$last_name' where Email='$email'");
        }

        //delete multiple items
        function deletemultiple($checked_list)
        {
            $this->db->where("Email", $checked_list);
            $this->db->delete("allusers");
            return true;
        }

    }
?>

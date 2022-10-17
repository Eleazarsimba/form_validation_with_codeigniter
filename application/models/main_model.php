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
            $this->db->where("Password", $password);
            $query = $this->db->get("allusers");
            if($query->num_rows() > 0)
            {
                return true;
            }
            else{
                return false;
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
    }
?>

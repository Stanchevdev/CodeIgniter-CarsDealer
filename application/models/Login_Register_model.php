<?php
  class Login_Register_model extends CI_Model
  {

    public function __construct()
    {
      $this->load->database();
    }

    public function insert($data)
    {
      $this->db->insert('users', $data);
      return $this->db->insert_id();
    }

    public function check_email($email)
    {
      $this->db->select('email');
      $this->db->from('users');
      $this->db->where('email', $email);
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {

      }
      else
      {
        return 'NULL';
      }
    }



    public function check_pass($data)
    {
      $this->db->select('password');
      $this->db->from('users');
      $this->db->where('email', $data['email']);
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {
        $result = $query->row();
        return $result->password;
      }
      else
      {
        return 'NULL';
      }
    }

    public function get_info_for_user($data)
    {
      $email = $data['email'];
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('email', $email);
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {
        return ($query->result_array())[0];
      }
      else
      {
        return 'NULL';
      }
    }



}

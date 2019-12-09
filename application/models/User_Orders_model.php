<?php
  class User_Orders_model extends CI_Model
  {

    public function __construct()
    {
      $this->load->database();
    }

    // INSERT INTO USERS ORDERS
    public function insert_into_orders($data)
    {
      $this->db->insert('user_orders', $data);
      return $this->db->insert_id();
    }

    public function insert_into_orderlines($data)
    {
      $this->db->insert('user_orderlines', $data);
    }


    public function get_info_for_orders($id)
    {
      $this->db->select('*');
      $this->db->from('user_orders');
      $this->db->where('user_id', $id);
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {
        return $query->result_array();
      }
      else
      {
        return 'NULL';
      }
    }


    public function get_info_for_single_order($id)
    {
      $this->db->select('*');
      $this->db->from('user_orderlines');
      $this->db->where('order_id', $id);
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {
        return $query->result_array();
      }
      else
      {
        return 'NULL';
      }
    }
}

<?php
  class Visitor_Orders_model extends CI_Model
  {

    public function __construct()
    {
      $this->load->database();
    }


    public function insert_into_visitors($data)
    {
      $sql = "SELECT email FROM visitors WHERE email = ?";
      $query = $this->db->query($sql, array($data['email']));
      if ($query->num_rows() > 0)
      {
        $sqlId = "SELECT id FROM visitors WHERE email = ?";
        $queryId = $this->db->query($sqlId, array($data['email']));
        $result = $queryId->row();
        return $result->id;
      }
      else
      {
        $this->db->insert('visitors', $data);
        return $this->db->insert_id();
      }
    }


    // INSERT INTO VISITORS ORDERS
    public function insert_into_orders($data)
    {
      $this->db->insert('orders', $data);
      return $this->db->insert_id();
    }

    public function insert_into_orderlines($data)
    {
      $this->db->insert('orderlines', $data);
    }
}

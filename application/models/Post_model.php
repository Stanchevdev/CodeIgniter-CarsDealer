<?php
  class Post_model extends CI_Model
  {

    public function __construct()
    {
      $this->load->database();
    }

    public function get_cars()
    {
      $query = $this->db->get('cars');
      return $query->result_array();
    }

    public function getPrice($id)
    {
      $this->db->select('price');
      $this->db->from('cars');
      $this->db->where('id', $id);
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


    public function get_single_product_by_get()
    {
      $id = $_GET['id'];
      $this->db->select('*');
      $this->db->from('cars');
      $this->db->where('id', $id);
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

    public function get_single_product_by_post($id)
    {
      $this->db->select('*');
      $this->db->from('cars');
      $this->db->where('id', $id);
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

    public function delete_single_product_by_post($id)
    {
      $this->db->where('id', $id);
      $this->db->delete('cars');
    }

    public function upload($data)
    {
      $this->db->insert('cars', $data);
    }

    public function edit_product($data)
    {
      $this->db->set('name', $data['name']);
      $this->db->set('model', $data['model']);
      $this->db->set('price', $data['price']);
      $this->db->where('id', $data['id']);
      $this->db->update('cars');
    }

  }

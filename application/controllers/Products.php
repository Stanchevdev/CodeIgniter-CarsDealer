<?php
session_start();
    class Products extends CI_Controller
    {
        public function index()
        {
            $data['cars'] = $this->post_model->get_cars();
            $this->load->view('templates/header');
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }


        public function productPage()
        {
            $data['carId'] = $this->post_model->get_single_product_by_get();
            $this->load->view('templates/header');
            $this->load->view('products/productpage', $data);
            $this->load->view('templates/footer');
        }

        public function adminProductPage()
        {
            $data['carId'] = $this->post_model->get_single_product_by_get();
            $this->load->view('templates/header');
            $this->load->view('admin/adminproductpage', $data);
            $this->load->view('templates/footer');
        }


    }

<?php
session_start();
    class Administrator extends CI_Controller
    {
        public function index()
        {
            if (!empty($_SESSION['loggedin']))
            {
              $data['cars'] = $this->post_model->get_cars();
              $this->load->view('templates/header');
              $this->load->view('admin/controlPanel', $data);
              $this->load->view('templates/footer');
            }
            else
            {
              $this->load->view('templates/header');
              $this->load->view('admin/login');
              $this->load->view('templates/footer');
            }
        }

        public function check()
        {
          if (isset($_POST['submit']))
          {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if ($user == 'admin' && $pass == 'admin')
            {
              $_SESSION['loggedin'] = $user;
              if (isset($_SESSION['userLogedIn']))
              {
                unset($_SESSION['userLogedIn']);
                $data['cars'] = $this->post_model->get_cars();
                $this->load->view('templates/header');
                $this->load->view('admin/controlPanel', $data);
                $this->load->view('templates/footer');
              }
              else
              {
                $data['cars'] = $this->post_model->get_cars();
                $this->load->view('templates/header');
                $this->load->view('admin/controlPanel', $data);
                $this->load->view('templates/footer');
              }
            }
            else
            {
              $data['warning'] = "Wrong inputs";
              $this->load->view('templates/header');
              $this->load->view('admin/login', $data);
              $this->load->view('templates/footer');
            }
          }
        }

        public function logout()
        {
            unset($_SESSION["loggedin"]);
            redirect(site_url(), 'refresh');
        }

//CRUD Operations

        public function editProduct()
        {
          if (isset($_POST['submitEdit']))
          {
            $name = $_POST['editName'];
            $model = $_POST['editModel'];
            $price = $_POST['editPrice'];
            $id = $_POST['id'];
            if (empty($name && $model && $price))
            {
              $data['warning'] = "Fill Something!";
              $this->load->view('templates/header');
              $this->load->view('admin/adminproductpage', $data);
              $this->load->view('templates/footer');
            }
            else
            {
              $msg = "Update is successful";
              $data = array('id' => $id, 'name' => $name, 'model' => $model, 'price' => $price);
              $this->post_model->edit_product($data);
              $carsdata['carId'] = $this->post_model->get_single_product_by_post($id);
              $carsdata['msg'] = $msg;
              var_dump($carsdata);
              redirect(site_url()."products/adminpage/?id=$id", $carsdata);
            }
          }
        }


        public function upload()
        {
          if (isset($_POST['submitUpload']))
          {
            $name = $_POST['name'];
            $model = $_POST['model'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $miniprice = $_POST['miniprice'];
            if (empty($name || $model || $description || $price))
            {
              $data['warning'] = "Something missing!";
              $this->load->view('templates/header');
              $this->load->view('admin/upload', $data);
              $this->load->view('templates/footer');
            }
            else
            {
              $msg = "Upload was successful";
              $formattedPrice = $price.'.'.$miniprice;
              if (!empty($miniprice))
              {
                $data = array('name' => $name, 'model' => $model, 'description' => $description, 'price' => $formattedPrice);
              }
              else
              {
                $data = array('name' => $name, 'model' => $model, 'description' => $description, 'price' => $price);
              }
              $this->post_model->upload($data);
              $carsdata['cars'] = $this->post_model->get_cars();
              $carsdata['msg'] = $msg;
              redirect("admin/login", $carsdata);
            }
          }
        }


        public function uploadView()
        {
          $this->load->view('templates/header');
          $this->load->view('admin/upload');
          $this->load->view('templates/footer');
        }



        public function deleteSelected()
        {
          $ids = file_get_contents('php://input');
          $idsarr = explode(",",$ids);
          for ($i=0; $i < count($idsarr); $i++)
          {
            $this->post_model->delete_single_product_by_post($idsarr[$i]);
          }
        }

        public function deleteProductToPage()
        {
          $data['carId'] = $this->post_model->get_single_product_by_get();
          $this->load->view('templates/header');
          $this->load->view('admin/deleteproductpage', $data);
          $this->load->view('templates/footer');
        }

        public function deleteProductForever()
        {
          $id = $_POST['idDel'];
          if (empty($id))
          {
            $data['warning'] = "Something missing!";
            echo "Bad Request";
          }
          else
          {
            $msg = "Delete was successful";
            $this->post_model->delete_single_product_by_post($id);
            $carsdata['cars'] = $this->post_model->get_cars();
            $carsdata['msg'] = $msg;
            $this->index();
          }
        }


    }

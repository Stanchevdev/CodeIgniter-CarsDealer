<?php
session_start();
    class UserFunctions extends CI_Controller
    {

      public function __construct()
      {
        parent::__construct();
        $this->load->library('form_validation');
      }

      public function index($msg = NULL)
      {
        $data['msg'] = $msg;
        $this->load->view('templates/header');
        $this->load->view('users/register', $data);
        $this->load->view('templates/footer');
      }

      public function validation()
      {
        $this->form_validation->set_rules('firstname', 'Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'required|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run())
        {
          $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
          $data = array(
            'first_name' => $_POST['firstname'],
            'last_name' => $_POST['lastname'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'password' => $hash
          );
          $email = $this->Login_Register_model->check_email($_POST['email']);
          if ($email == 'NULL')
          {
            $id = $this->Login_Register_model->insert($data);
            $msg = 'Successful registration';
            $this->index($msg);
          }
          else
          {
            $msg = 'Email exists';
            $this->index($msg);
          }
        }
        else
        {
          $this->index();
        }
      }

      public function cp()
      {
        $data['user'] = $_SESSION['userLogedIn'];
        $this->load->view('templates/header');
        $this->load->view('users/UserCp', $data);
        $this->load->view('templates/footer');
      }

      public function loginCheck()
      {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run())
        {
          $dataCheck = array(
            'email' => $_POST['email'],
            'password' => $_POST['pass']
          );
          $passwordForDecrypting = $this->Login_Register_model->check_pass($dataCheck);
          if ($passwordForDecrypting != 'NULL')
          {
            if (password_verify($dataCheck['password'], $passwordForDecrypting))
            {
              $dataUser = $this->Login_Register_model->get_info_for_user($dataCheck);
              $_SESSION['userLogedIn'] = $dataUser;
              if (isset($_SESSION['loggedin']))
              {
                unset($_SESSION['loggedin']);
                $this->cp();
              }
              else
              {
                $this->cp();
              }
            }
            else
            {
              $badMsg = 'Wrong password';
              $this->loginView($badMsg);
            }
          }
          else
          {
            $badMsg = 'Wrong email';
            $this->loginView($badMsg);
          }
        }
        else
        {
          $this->index();
        }
      }

      public function loginView($msg = NULL)
      {
        $data['msg'] = $msg;
        $this->load->view('templates/header');
        $this->load->view('users/UserLogin', $data);
        $this->load->view('templates/footer');
      }

      public function ordersHistory()
      {
        $data['order'] = $this->User_Orders_model->get_info_for_orders($_SESSION['userLogedIn']['id']);
        $this->load->view('templates/header');
        $this->load->view('users/OrdersHistory', $data);
        $this->load->view('templates/footer');
      }

      public function singleOrderView()
      {
        $id = $_GET['id'];
        $data['orderline'] = $this->User_Orders_model->get_info_for_single_order($id);
        $this->load->view('templates/header');
        $this->load->view('users/singleOrder', $data);
        $this->load->view('templates/footer');
      }



      public function userLogout()
      {
          unset($_SESSION["userLogedIn"]);
          unset($_SESSION['cart']);
          redirect(site_url(), 'refresh');
      }


}

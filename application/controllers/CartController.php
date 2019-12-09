<?php
session_start();
    class CartController extends CI_Controller
    {

      public function index()
      {
        $i = 0;
        if (isset($_SESSION['cart']))
        {
          foreach ($_SESSION['cart'] as $cart)
          {
            $data['cars'][$i] = $this->post_model->get_single_product_by_post($cart['item_id']);
            if ($data['cars'][$i] == 'NULL')
            {
              unset($data['cars'][$i]);
              unset($_SESSION["cart"][$i]);
            }
          $i++;
          }

            $_SESSION['cart'] = array_values($_SESSION['cart']);
            if (isset($data))
            {
              $this->load->view('templates/header');
              $this->load->view('products/cart', $data);
              $this->load->view('templates/footer');
            }
            else
            {
              $this->load->view('templates/header');
              $this->load->view('products/cart');
              $this->load->view('templates/footer');
            }
        }
        else
        {
          $data['cars'] = 'No Items added';
          $this->load->view('templates/header');
          $this->load->view('products/cart', $data);
          $this->load->view('templates/footer');
        }
      }


      public function addToCart()
      {
        if (isset($_POST['addToCart']))
        {
          $id = $_POST['id'];
          $quantity = $_POST['quantity'];
          if (isset($_SESSION["cart"]))
        	{
        		$item_array_id = array_column($_SESSION["cart"], "item_id");
        		if (!in_array($id, $item_array_id))
        		{
        			$count = count($_SESSION["cart"]);
        			$item_array = array(
        				'item_id'	=> $id,
        				'item_quantity'	=> $quantity
        			);
        			$_SESSION["cart"][$count] = $item_array;
              $data['msg'] = "Item added";
              $data['carId'] = $this->post_model->get_single_product_by_post($id);
              redirect(site_url()."products/view/?id=$id", $data);
        		}
        		else
        		{
              $data['msg'] = "Item has been already added";
              $data['carId'] = $this->post_model->get_single_product_by_post($id);
              redirect(site_url()."products/view/?id=$id", $data);
        		}
        	}
        	else
        	{
        		$item_array = array(
              'item_id'	=> $id,
              'item_quantity'	=> $quantity
        		);
        		$_SESSION["cart"][0] = $item_array;
            $data['msg'] = "Item added";
            $data['carId'] = $this->post_model->get_single_product_by_post($id);
            redirect(site_url()."products/view/?id=$id", $data);
        	}
        }
      }

      public function removeFromCart()
      {
        foreach($_SESSION["cart"] as $keys => $values)
        {
          if ($values["item_id"] == $_GET["id"])
          {
            unset($_SESSION["cart"][$keys]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            redirect(site_url()."cart");
          }
        }
      }

      public function buynextstep()
      {
        if (!empty($_SESSION['cart']))
        {
          $data['totalPrice'] = $_SESSION['VatTotal'];
          $this->load->view('templates/header');
          $this->load->view('products/userInformation', $data);
          $this->load->view('templates/footer');
        }
        else
        {
          $badmsg = "You didn't ordered any products";
          return $this->returnView($badmsg);
        }

      }

      private function returnView($msg)
      {
        $data['msg'] = $msg;
        $this->load->view('templates/header');
        $this->load->view('pages/home', $data);
        $this->load->view('templates/footer');
      }

      public function visitorInfoHandling()
      {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        if (empty($fname) || empty($lname) || empty($email) || empty($address))
        {
          $badmsg = 'Something missing';
          return $this->returnView($badmsg);
        }
        else
        {
          $user = array('first_name' => $fname, 'last_name' => $lname, 'email' => $email);
          $checkIfUser = $this->Login_Register_model->get_info_for_user($user);
          if ($checkIfUser != 'NULL')
          {
            $badmsg = 'You are registered user. Sign in and make your order!';
            return $this->returnView($badmsg);
          }
          else
          {

            $lastUser = $this->Visitor_Orders_model->insert_into_visitors($user);

            $order = array('user_id' => $lastUser, 'computed_price' => $_SESSION['TotalSum'], 'delivery_address' => $address);
            $lastOrderId = $this->Visitor_Orders_model->insert_into_orders($order);
            $i = 0;
            foreach ($_SESSION['cart'] as $cart)
            {
              $data['price'][$i] = $this->post_model->getPrice($cart['item_id']);
              $price = floatval(implode($data['price'][$i]));
              $singleProductPrice = $price*floatval($cart['item_quantity']);
              $orderline = array('order_id' => $lastOrderId, 'product_id' => $cart['item_id'], 'order_quantity' => $cart['item_quantity'], 'single_price' => $singleProductPrice);
              $this->Visitor_Orders_model->insert_into_orderlines($orderline);
              $i++;
            }
            $goodmsg = 'Your order has been inserted';
            return $this->returnView($goodmsg);
          }
        }
      }

      public function userInfoHandling()
      {
        $address = $_POST['address'];
        if (empty($address))
        {
          $badmsg = 'Missing Address';
          return $this->returnView($badmsg);
        }
        else
        {
          $i = 0;
          $order = array('user_id' => $_SESSION['userLogedIn']['id'], 'computed_price' => $_SESSION['TotalSum'], 'delivery_address' => $address);
          $lastOrderId = $this->User_Orders_model->insert_into_orders($order);

          foreach ($_SESSION['cart'] as $cart)
          {
            $data['price'][$i] = $this->post_model->getPrice($cart['item_id']);
            $price = floatval(implode($data['price'][$i]));
            $singleProductPrice = $price*floatval($cart['item_quantity']);
            $orderline = array('order_id' => $lastOrderId, 'product_id' => $cart['item_id'], 'order_quantity' => $cart['item_quantity'], 'single_price' => $singleProductPrice);
            $this->User_Orders_model->insert_into_orderlines($orderline);
            $i++;
          }
          $goodmsg = 'Your order has been inserted';
          return $this->returnView($goodmsg);
        }
      }

    }

<html>
  <head>
    <title>CodeIgniter</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script>
        function add() {
          var counter = document.getElementById("counter");
          counter.value++;
        };
        function decrease() {
          var counter = document.getElementById("counter");
          counter.value--;
          if (counter.value < 1) {
            counter.value = 1;
          }
        };
        function add10() {
          var counter = document.getElementById("counter");
          var added = counter.value++;
          counter.value = added + 10;
        };
        function decrease10() {
          var counter = document.getElementById("counter");
          counter.value = counter.value - 10;
          if (counter.value < 1) {
            counter.value = 1;
          }
        };

        function summed() {
          var price = document.getElementById("price").getAttribute('value');
          var counter = document.getElementById("counter").value;
          var res = price * parseInt(counter);
          var restofix = res.toFixed(2);
          document.getElementById("summedp").innerHTML = restofix;
        }

        var ids = [];

        var items = document.getElementsByClassName('myclass');

        function createBtn(){
          var btnId = document.getElementById('deleteBtnId');
          if (ids.length === 0) {
            if (btnId) {
              btnId.remove();
            }
          }
          else{
            if (btnId) {

            }
            else{
              var btn = document.createElement("BUTTON");
              btn.innerHTML = "Delete Selected";
              btn.setAttribute('id', 'deleteBtnId');
              btn.setAttribute('class', 'btn btn-danger');
              btn.onclick = function () {
                var httpc = new XMLHttpRequest(); // simplified for clarity
                var url = "../products/deleteSelected";
                httpc.open("POST", url, true); // sending as POST

                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                httpc.setRequestHeader("Content-Length", ids.length); // POST request MUST have a Content-Length header (as per HTTP/1.1)

                httpc.onreadystatechange = function() { //Call a function when the state changes.
                  if (httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
                    location.reload(); // some processing here, or whatever you want to do with the response
                  }
                };
                httpc.send(ids);
              };
              document.getElementById("inner").appendChild(btn);
            }
          }
        }

        function selectAll(){
          UnSelectAll();
          for (var i = 0; i < items.length; i++) {
            var id = parseInt(items[i].id);
            ids.push(id);
            items[i].style.backgroundColor = 'red';
          }
          createBtn();
        }

        function UnSelectAll(){
          for (var i = 0; i < items.length; i++) {
            items[i].style.backgroundColor = 'white';
          }
          ids = [];
          createBtn();
        }



        function changeColor(id){
          var itemId=document.getElementById(id);
          if (ids.length === 0){
            itemId.style.backgroundColor = 'red';
            ids.push(id);
          }
          else{
            if (ids.includes(id)) {
              itemId.style.backgroundColor = 'white';
              ids = ids.filter(ik => ik !== id);
            }
            else {
              ids.push(id);
              itemId.style.backgroundColor = 'red';
            }
          }
          console.log(ids);
          createBtn();
        }



    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="/">CarsDealer</a>
      <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>posts">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>about">About</a>
            </li>
            <?php
            if (!empty($_SESSION['userLogedIn']))
            {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>Cp">Control Panel</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url();?>OrdersHistory">History of orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url();?>User/Logout">Logout</a>
              </li>
            <?php
            }
            else
            {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>User/Registration">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>User/Login">Sign In</a>
            </li>
            <?php
            }

              if (!empty($_SESSION['loggedin']))
              {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url();?>admin/login">Control Panel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url();?>products/uploadform">Upload Your Car</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url();?>admin/logout">Logout</a>
              </li>
            <?php
            }
            else
            {
            ?>
            <li class="nav-item" style="position:absolute; top:0; right:0;">
              <a class="nav-link" href="<?php echo site_url();?>admin/login"> </a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url();?>cart"><i class="fas fa-shopping-cart" style="font-size:1vw;"></i>
              <?php
                if (isset($_SESSION['cart']))
                {
                echo count($_SESSION['cart']);
                }
              ?>
            </a>
            </li>
          </ul>
        </div>
      </nav>
    <div class="jumbotron">

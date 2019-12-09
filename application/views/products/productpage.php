<a href="<?php echo site_url();?>posts" class="btn btn-primary">Back to the list</a>
<br/><br/><br/><br/><br/>
<?php
  if (!empty($msg))
  {
?>
  <p><?php echo $msg; ?></p>
<?php
  }
?>
<?php
  if ($carId == 'NULL')
  {
    echo "Sorry, this product has been deleted by the admin";
  }
  else
  {
    foreach ($carId as $car) :
?>
  <div class="card mb-3" style="width:30%;">
    <h3 class="card-header"><?php echo $car['id']?> <?php echo $car['name']; ?> <?php echo $car['model']; ?></h3>
    <img style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image">
    <ul class="list-group list-group-flush">
      <label>Price:</label>
      <li class="list-group-item" id="price" value="<?php echo $car['price']; ?>"><?php echo $car['price']; ?></li>
    </ul>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <form action="<?php echo site_url(); ?>cart/addtocart" method="post">
          <div class="form-group" style="display:block;">
            <span onclick="decrease10(); summed()" id="dec10" class="counters"><i class="fas fa-minus"></i>10</span>
            <br/>
            <span onclick="decrease(); summed()" id="dec" class="counters"><i class="fas fa-minus"></i></span>
            <br/>
            <input type="text" name="quantity" class="form-control" value="1" size="2" id="counter" readonly="readonly">
            <input type="hidden" name="id" value="<?php echo $car['id']?>">
            <br/>
            <span onclick="add(); summed()" id="add" class="counters"><i class="fas fa-plus"></i></span>
            <br/>
            <span onclick="add10(); summed()" id="add10" class="counters"><i class="fas fa-plus"></i>10</span>
            <br/>
            <div class="input-group-append">
            <p>Общо: <span id="summedp"></span> лв.</p>
          </div>
          <input type="submit" name="addToCart" class="btn btn-success" value="Add to cart">
        </form>
      </li>
    </ul>
  </div>
  <br/>
<?php
    endforeach;
  }
?>

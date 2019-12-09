<table class="table table-hover">
  <tbody>
      <tr>
        <th scope="col">Brand</th>
        <th scope="col">Model</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
      </tr>
    <?php
      if (!empty($_SESSION['cart']))
      {
        $total = 0;
        $i = 0;
        // print_r($_SESSION['cart']);
        foreach ($cars as $car)
        {
          $total = $total + ($car['price'] * $_SESSION['cart'][$i]['item_quantity']);
    ?>
      <tr class="table-success">
        <td><?php echo $car['name'];?></td>
        <td><?php echo $car['model'];?></td>
        <td><?php echo $car['price'];?></td>
        <td><?php echo $_SESSION['cart'][$i]['item_quantity'];?></td>
        <td><a href="cart/removefromcart/?id=<?php echo $car['id']; ?>" style="text-decoration:none; color:#a52a2a;"><i class="fas fa-trash-alt" style="font-size:1.2vw;"></i></a></td>
      </tr>
      <?php
        $i++;
      }
        $VAT = 20;
        $VatPrice = ($total / 100) * $VAT;
        $_SESSION['VatTotal'] = number_format($VatPrice + $total, 2);
        $_SESSION['TotalSum'] = $total;
      ?>
      <tr>
        <td>Общо</td>
        <td>ДДС: <?php echo number_format($VatPrice, 2); ?> лв.</td>
        <td>Общо: <?php echo $_SESSION['VatTotal']; ?> лв.</td>
        <td><a href="cart/buynextstep" style="text-decoration:none; color:#7FFF00;"><i class='fas fa-hand-holding-usd' style="font-size:1.2vw;" id="payment"></i></a></td>
      </tr>
    <?php
    }
    else
    {
    ?>
      <tr class="table-danger">
        <td>No Items added</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

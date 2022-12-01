<?php

// echo '<pre>';
// var_dump($Order);
// echo '</pre>';

?>



<section id="order">
    <table class="highlight responsive-table striped">
        <thead>
          <tr>
              <th>Имя</th>
              <th>Телефон</th>
              <th>Название товара</th>
              <th>Цена товара</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach ($Order as $order) : ?>
          <tr>
            <td><?=$order['full_name']?></td>
            <td><?=$order['tel']?></td>
            <td><?=$order['title']?></td>
            <td>$<?=$order['price']?></td>
          </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
</section>
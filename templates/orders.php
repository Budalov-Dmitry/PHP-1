<?php
foreach ($products as $item):?>
    <div>
            <img src="/img/small/<?=$item['image']?>" alt="">
            <p>Описание:<?=$item['description']?></p>
            <p>цена <?=$item['price']?> рублей</p>
            <form action="/orders/delete" method="post">
                Имя:<input type="text" name="firstname" value="<?=$item['firstname']?>"  >
                Фамилия:<input type="text" name="lastname" value="<?=$item['lastname']?>" >
                Телефон:<input type="text" name="phone" value="<?=$item['phone']?>" >
                <input type="text" name="id" value="<?=$item['id']?>" hidden>    
                <input type="text" name="basket_id" value="<?=$item['basket_id']?>" hidden>
                <input type="text" name="image" value="<?=$item['image']?>" hidden>
                <input type="text" name="description" value="<?=$item['description']?>" hidden>
                <input type="text" name="price" value="<?=$item['price']?>" hidden>
                <input type="submit" value="отменить покупку">
            </form>
    </div><br>
<?php endforeach;?>
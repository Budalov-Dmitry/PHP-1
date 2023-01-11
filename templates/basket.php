<?if ($summ) :?>общая сумма:<?=$summ?> рублей<? endif; ?>

<?php  
foreach ($products as $item):?>
    <div>
            <img src="/img/small/<?=$item['image']?>" alt="">
            <p>Описание:<?=$item['description']?></p>
            <p>цена <?=$item['price']?> рублей</p>
            <form action="/basket/delete" method="post">
                <input type="text" name="id" value="<?=$item['id']?>" hidden>
                <input type="submit" value="отменить покупку">
            </form>
            <form action="/basket/buy" method="post">
                <input type="text" name="firstname" placeholder="имя"  >
                <input type="text" name="lastname" placeholder="фамилия" >
                <input type="text" name="phone" placeholder="телефон" >
                <input type="text" name="id" value="<?=$item['id']?>" hidden>
                <input type="text" name="image" value="<?=$item['image']?>" hidden>
                <input type="text" name="description" value="<?=$item['description']?>" hidden>
                <input type="text" name="price" value="<?=$item['price']?>" hidden>
                <input type="submit" value="оформить заказ">
            </form>
    </div><br>
<?php endforeach;?>
<?php  
 //var_dump($_POST);
 //var_dump($item['id']);
foreach ($product as $item):?>
    <div>
            <img src="/img/small/<?=$item['image']?>" alt="">
            <p>Описание:<?=$item['description']?></p>
            <p>цена <?=$item['price']?></p>
            <form action="/product/buy/?id=<?=$_GET['id']?>" method="post">
                <input type="text" name="id" value="<?=$item['id']?>" hidden>
                <input type="submit" value="купить">
            </form>
    </div><br>
<?php endforeach;?>
<form action="/product/<?if ($array_request) :?>save<? else: ?>add<? endif; ?>/?id=<?=$_GET['id']?>" method="post">
Оставьте отзыв: <br>
    <input type="text" name="id" value="<?=$array_request['id']?>" hidden>
    <input type="text" name="name" value="<?=$array_request['name']?>" ><br>
    <input type="text" name="text" value="<?=$array_request['text']?>" ><br> 
    <input type="submit" value="<?if ($array_request) :?>Править<? else: ?>добавить<? endif; ?>">
</form>
другие отзывы: <br>
<?php foreach ($feedback as $value): ?>
    <div>
        <b><?=$value['name']?></b>: <?=$value['text']?> 
        <form action="/product/delete/?id=<?=$_GET['id']?>" method="post" >
            <input type="text" name="id" value="<?=$value['id']?>" hidden>
            <input type="submit" value="[x]">
        </form>
        <form action="/product/edit/?id=<?=$_GET['id']?>" method="post" >
            <input type="text" name="edit_id" value="<?=$value['id']?>" hidden>
            <input type="submit" value="edit">
        </form>
    </div>
<?php endforeach;?>

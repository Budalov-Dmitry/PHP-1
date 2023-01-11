<h2>фотки</h2>

<?php 
foreach ($products as $item):?>
    <div>
        <a href="/product/?id=<?=$item['id']?>">
            <img src="img/small/<?=$item['image']?>" alt="">
        </a>
    </div>
<?php endforeach;?>
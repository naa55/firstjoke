<div>
    <?php if(isset($error)):  ?>
            <p><?=$error?></p>
        <?php else: ?>
            <?php foreach($favlist as $fav) : ?>
                <p>hello</p>
                <p><?=htmlspecialchars($fav['joketext'], ENT_QUOTES, 'UTF-8')?></p>
            <?php endforeach; ?>
    <?php endif; ?>
</div>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>List of authors profile</p>
    <?php if(isset($error)) : ?>
        <p><?=$error?></p>
    <?php else :?>
        <p>
        <?php foreach($authors as $author) :?>
            <?= htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
           <?php endforeach; ?>
           <?php endif;?> 
</body>
</html>

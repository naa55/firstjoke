<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="
    jokes.css">

    <title>Document</title>
</head>
<body>
    <style>
        /* .jokes {
            margin: 10px;
        } */
     
    </style>
    
        <p><?=$totalJokes?> Have been submitted into the database</p>
        
    <?php if(isset($error)): ?>
        <p><?= $error ?></p>
        <?php else: ?>
            <blockquote>
                <p class="jokes">
                    <?php foreach($jokes as $joke) : ?>
                    <?= htmlspecialchars($joke["joketext"], ENT_QUOTES, "UTF-8") ?>
                    (by <a href="mailto:<?php
                    echo htmlspecialchars($joke['email'], ENT_QUOTES,
                    'UTF-8'); ?>"><?php
                    echo htmlspecialchars($joke['name'], ENT_QUOTES,
                    'UTF-8'); ?></a>)
                    <?php $date = new DateTime($joke['jokedate']);
                        echo $date->format('jS F Y'); ?>
                             <?php if ($userId == $joke['authorId']): ?>
                                <form action="index.php?route=joke/edit/id" method="post">
                                    <input type="hidden" name="id"
                                    value="<?=$joke["id"]?>">
                                    <input type="submit" value="Edit" style="background-color: transparent; text-decoration:underline; outline:none; border:none; cursor:pointer;">
                                </form>
                                <form action="index.php?route=joke/delete" method="post">
                                    <input type="hidden" name="id"
                                    value="<?=$joke["id"]?>">
                                    <input type="submit" value="Delete">
                                </form>
                            <?php endif; ?> 
                    <form action="index.php?route=joke/favoriate" method='post'>
                        <input type="hidden" name="id" value="<?=$joke["id"]?>">
                        <input type="submit"  value="favoriate"/>
                </form>
                </p>
            </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
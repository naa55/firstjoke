<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="jokes.css">
<title><?=$title?></title>
</head>
    <body>
  
      
        <nav class="navbar">
        <header>
            <h1>Internet Joke Database</h1>
        </header>
            <ul class="list">
            <li><a
            href="index.php?route=joke/home">Home</a></li>
            <li><a href="index.php?route=joke/list">Jokes
            List</a></li>
            <li><a href="index.php?route=joke/edit">Add a new Joke</a></li>
            <?php if ($loggedIn): ?>
                <li><a href="index.php?route=joke/favlist">Favoriate</a>
                    </li>
                    <li><a href="index.php?route=logout">Log out</a>
                    </li>
                <?php else: ?>
                    <li><a href="index.php?route=login">Log in</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <main>
            <?=$output?>
        </main>
        <footer>
            &copy; IJDB 2017
        </footer>
    </body>
</html>

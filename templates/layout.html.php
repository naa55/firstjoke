<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="./../jokes.css">
<title><?=$title?></title>
</head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
      <div class="container">
        <a href="/" class="navbar-brand">Joke Database</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggle-icon">X</span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item dropdown ">
              <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Profile</a>
              <ul class="dropdown-menu m-2">
                <li><a href="/profile/edit" class="dropdown-item">Add Profile</a></li>
                <li><a href="#" class="dropdown-item">Edit</a></li>
                <li><a href="#" class="dropdown-item">List</a></li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <a href="/" class="nav-link">Home</a>
          </ul>
          <ul class="navbar-nav">
            <a href="/joke/list" class="nav-link">Joke List</a>
          </ul>
          <ul class="navbar-nav">
            <a href="/joke/edit" class="nav-link">AddJoke</a>
          </ul>
          <ul class="navbar-nav">
          <?php if ($loggedIn): ?>
                    <a href="/logout" class="nav-link">Logout</a>
                <?php else: ?>
                    <a href="/login" class="nav-link">Login</a>
                <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
        <main class="container">
                <img src="/8q60J1GG_400x400.jpg" alt="">
            <?=$output?>
        </main>
        <footer>
            &copy; IJDB 2017
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>

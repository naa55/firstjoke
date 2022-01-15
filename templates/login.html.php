<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($error)):
    echo '<div class="errors">' . $error . '</div>';
endif;
?>


<form method="post" action="">
    <label for="email">Your email address</label>
        <input type="text" id="email" name="email">
        <br>
    <label for="password">Your password</label>
        <input type="password" id="password" name="password">
        <br>
    <input type="submit" name="login" value="Log in">
</form>
<p>Don't have an account? <a
 href="index.php?route=author/register">Click here to register an
account</a></p>
</body>
</html>
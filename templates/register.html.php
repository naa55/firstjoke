<div>
<?php if(!empty($errors)) : ?>
        <div class="errors">
        <p>Your account could not be created,
        please check the following:</p>
        <ul>
            <?php foreach($errors as $error) : ?>
                <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
<?php endif; ?>
<div class="w-50 border border-3 m-auto p-5 mt-5">
<form action="" method="post">
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Your email address</label>
        <input name="author[email]" class="form-control" id="email" type="text" value="<?=$author['email'] ?? ''?>">
  </div>
  <div class="mb-3>
    <label for="name"  class="form-label">Your name</label>   
    <input name="author[name]" class="form-control" id="name" type="text" value="<?=$author['name'] ?? ''?>">
  </div>
   <div class="mb-3">
    <label for="password"  class="form-label">Password</label>
    <input name="author[password]" class="form-control" id="password" type="password" value="<?=$author['password'] ?? ''?>">
   </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Register account">
</form>
</div>

</div>
  

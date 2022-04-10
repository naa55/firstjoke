<div class="mt-5">
<h2>Edit <?=$author->name?>’s Permissions</h2>
<form action="" method="post">
    <?php foreach ($permissions as $name => $value): ?>
    <div>
        <input name="permissions[]" type="checkbox" value="<?=$value?>"
        <?php if ($author->hasPermission($value)): echo 'checked'; endif; ?> /><label class="ms-3"><?=$name?>
    </div>
    <?php endforeach; ?>
    <input type="submit" class="btn btn-primary mt-3" value="Submit" />
</form>
</div>
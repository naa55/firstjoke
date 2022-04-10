<div>
    <h2>My Profile Information</h2>
    <?php if(isset($profile)) :?>
        <p>Bio: <?=$profile->bio ?></p>   
        <p>Hobbie: <?= $profile->hobbie ?></p>
        <?php if($userId == $profile->authorid) :?>
        <a class="me-2" href="/profile/edit?id=<?=$profile->id?>">Edit Profile</a>
        <?php endif; ?>
        <?php else :?>
            <p>Not found</p>
    <?php endif ?>
      
</div>
<div>  
    <form action="" method="post">
        <input type="hidden" name="profile[id]" value="<?=$profile->id ?? ''?>">
            <label for="profile">Type your bio:</label>
            <textarea id="profile" name="profile[bio]" rows="3
            " cols="40"><?=$profile->bio ??''?></textarea>
            <label for="profile">Type your Hobbie:</label>
            <textarea id="profile" name="profile[hobbie]" rows="3
            " cols="40"><?=$profile->hobbie ??''?></textarea>
        <input type="submit" name="submit" value="Save">
        </form>
</div>
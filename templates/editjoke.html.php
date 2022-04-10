<div>
    <?php if (empty($joke->id) || $userId == $joke->authorid):?>
        <form action="" method="post">
        <input type="hidden" name="joke[id]" value="<?=$joke->id ?? ''?>">
          <div class="w-50 mt-5 ms-5 mb-5">
          <label for="joketext" class="form-label">Type your joke here:</label>
            <textarea id="joketext" class="form-control" name="joke[joketext]" rows="5"><?=$joke->joketext ??''?></textarea>
          </div>
           <div class="ms-5">
           <p>Select categories for this joke:</p>
                <?php foreach ($categories as $category): ?>
                    <?php if ($joke &&
                        $joke->hasCategory($category->id)): ?>
                        <input type="checkbox" checked name="category[]"
                        value="<?=$category->id?>" />
                        <?php else: ?>
                        <input type="checkbox" name="category[]"
                        value="<?=$category->id?>" />
                    <?php endif; ?>
                <label><?=$category->name?></label>
                <?php endforeach; ?>
            <input type="submit" name="submit" class="btn btn-primary" value="Save">
           </div>
        </form>
    <?php else:?>
        <p>You may only edit jokes that you posted.</p>
    <?php endif; ?>
</div>
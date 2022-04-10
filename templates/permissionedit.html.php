    <p>Edit Joke</p><input type="checkbox" value="1" <?php if($author->hasPermission('EDIT_JOKES')) {
    echo 'checked';
    } ?> />
    <input type="checkbox" value="2" <?php if($author->hasPermission('DELETE_JOKES')) {
    echo 'checked';} ?> />Delete Jokes
    <input type="checkbox" value="3" <?php if($author->hasPermission('LIST_CATEGORIES')) {
    echo 'checked';
    } ?> />Add Categories

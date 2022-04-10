<div>
    <h2>Categories</h2>
    <a class="page-link bg-secondary  text-white text-center mb-5 mt-5 rounded-1" style="width: 200px;" href="/category/edit">Add new category</a>
    <?php foreach($categories as $category): ?>
        <div class="list-group">
        <div class="list-group-item d-flex justify-content-between align-items-center">
        <?=htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8')?>
          <div class="btn-group">
          <a class="page-link bg-secondary text-white me-2" href="/category/edit?id=<?=$category->id?>">Edit</a>
            <form action="/category/delete" method="post">
                 <input type="hidden" name="id"
                    value="<?=$category->id?>">
                  <input type="submit" value="Delete"  class="btn btn-danger me-2">
             </form>
          </div>
        </div>
        </div>
        <?php endforeach?>
</div>
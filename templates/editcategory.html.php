<div class="w-50 mt-5  mb-5">
    <form action="/category/edit" method="post">
        <input type="hidden" name="category[id]" value="<?=$category->id ?? ''?>">
        <label for="categoryname" class="form-label">Enter category name:</label>
        <input type="text" id="categoryname" class="form-control" name="category[name]" value="<?=$category->name ?? ''?>" />
        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Save">
    </form>        
</div>
   

<div>
    <h2 class="mt-5">User List</h2>
    <table class="table table-responsive-sm table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Permission</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($authors as $author) :?>
                <tr>
                    <td><?=$author->name;?></td>
                    <td><?=$author->email;?></td>
                    <td><a  href="/author/permissions?id=<?=$author->id;?>">Edit Permissions</a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <ul class="pagination pagination-lg justify-content-center mt-5 sticky-top">
                        <?php $numPages = ceil($authTotal/2);
                        for ($i = 1; $i <= $numPages; $i++):?>
                        <?php  if ($i == $currentPage): ?>
                        <li class="page-item active"><a href="/author/list?page=<?=$i?>" class="page-link"><?=$i?></a></li>
                            <?php else: ?>
                        <li class="page-item"><a href="/author/list?page=<?=$i?>" class="page-link"><?=$i?></a></li>
                        <?php endif;?>
                        <?php endfor; ?>
                        

            </ul>
</div>
    


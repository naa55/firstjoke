<div?>
<style>
            .currentpage {
                font-size: 2rem;
            }
        </style>
      
<div class="list-group mb-5 mt-3">
    <div class="list-group-item d-flex justify-content-between align-items-center">
    <ul id="categories" class="nav" >
        <?php foreach($categories as $category) :?>
            <li class="nav-item">
                <a class="nav-link" href="/joke/list?category=<?=$category->id?>"><?=$category->name?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>     
</div>
        <p><?=$totalJokes?> Have been submitted into the database</p>
        
    <?php if(isset($error)): ?>
        <p><?= $error ?></p>
        <?php else: ?>
      <div>
            <div class="list-group">
                <?php foreach($jokes as $joke) : ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <?= htmlspecialchars($joke->joketext, ENT_QUOTES, "UTF-8") ?>
                            (by <a href="mailto:<?php
                            echo htmlspecialchars($joke->getAuthor()->email, ENT_QUOTES,
                            'UTF-8'); ?>"><?php
                            
                            echo htmlspecialchars($joke->getAuthor()->name, ENT_QUOTES,
                            'UTF-8'); ?></a>)
                            <?php $date = new DateTime($joke->jokedate);
                            echo $date->format('jS F Y'); ?>
                            <a class="me-2" href="/profile/user?id=<?=$joke->getAuthor()->id?>">Profile</a>
                            </div>
                            <div class="btn-group">
                         <?php if ($userId == $joke->authorid): ?>
                                <a class="page-link bg-secondary text-white  me-2" href="/joke/edit?id=<?=$joke->id?>">Edit</a>
                            <form action="/joke/delete" method="post">
                                <input type="hidden" name="id"
                                value="<?=$joke->id?>">
                                <input type="submit" value="Delete" class="btn btn-danger me-2">
                            </form>
                            <?php endif; ?> 
                            <form action="/joke/favoriate" method='post'>
                                <input type="hidden" name="id" value="<?=$joke->id?>">
                                <input type="submit"  value="favoriate" class="btn btn-success"/>
                            </form>
                         </div>
                        </div>  
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

    <p>Select Page: </p>
    <!-- Calculaye thr number of pages -->
   
             <ul class="pagination pagination-lg justify-content-center mt-5 sticky-top">
                        <?php $numPages = ceil($totalJokes/5);
                        for ($i = 1; $i <= $numPages; $i++):?>
                        <?php  if ($i == $currentPage): ?>
                        <li class="page-item active"><a href="/joke/list?page=<?=$i?><?=!empty($_GET['category']) ? '&category=' . $_GET['category']: '' ?>" class="page-link"><?=$i?></a></li>
                            <?php else: ?>
                        <li class="page-item"><a href="/joke/list?page=<?=$i?>
                        <?=!empty($_GET['category']) ? '&category=' . $_GET['category'] : '' ?>" class="page-link"><?=$i?></a></li>
                        <?php endif;?>
                        <?php endfor; ?>
                        

            </ul>
                </div>
           


    <?php
    if (isset($error)):
        echo '<div class="errors alert alert-danger mt-5  alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>' . $error . '</strong></div>';
    endif;
    ?>
    <div class="w-50 border border-3 m-auto p-5 mt-5">
         <form method="post" action="">
             <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
                    <!-- <div class="mb-3">
                       <label for="comment">Comments:</label>
                       <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
                    </div> -->
            <button type="submit" name="login" value="log in" class="btn btn-primary">Submit</button>
            <p>Don't have an account? <a href="/author/register">Click here to register an
        </form>
    </div>


<div class="container">
    <div class="row">
        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>Post title: <?php echo $post->title; ?></h1>
            <h2>The Comment Section</h2>
            <h3> <?php echo $post->created_at; ?></h3>
                <?php


                if ($comments->count()) {
                    foreach ($comments->results() as $c) {
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h4 class="card-title">Mit Navn er  ' . $c->username . '  </h4>';
                        echo '<h5 class="card-title">Comment date: ' . $c->created_at . '</h5>';
                        echo '<p class="card-text">' . $c->content . '</p>';

                        if ($c->user_id === $user->data()->uid) {
                            echo '<form action="" method="post" name="delete_comment_form">';
                            echo '<input type="hidden" name="comment_id" value="' . $c->comment_id . '">';
                            echo '<input type="submit" name="submit" class="submit" value="Delete Comment">';
                            echo '</form>';
                        }



                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger"><strong></strong>No comments found!</div>';
                }

                ?>
                <div class="container" style="padding-top: 5%; padding-bottom: 5%;">
                    <h2>Comment</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Your Comment :</label>
                            <input type="text" class="form-control" id="comment" placeholder="Enter Your Comment" name="comment" value="<?php echo escape(Input::get('comment')); ?>">
                        </div>
                        <input type="submit" class="btn-register" value="Sumbit">
                        <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
                    </form>
                </div>
        </div>
    </div>
</div>
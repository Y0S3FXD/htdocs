<div class="container">
    <div class="row">
        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>Posts Overview in the <?php echo $channel->name; ?> channel</h1>

            <?php
            echo '<a href="create-post.php?channel_id=' . $channel_id . '" class="btn btn-primary">Create Post</a>';

            if ($posts->count()) {
                foreach ($posts->results() as $p) {
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title">' . $p->title . '</h4>';
                    echo '<p class="card-text">' . $p->content . '</p>';
                    echo '<a href="comments.php?post_id=' . $p->post_id . '" class="btn btn-primary">View Post</a>';
                    if ($p->user_id === $user->data()->uid) {
                    echo '<form action="" method="post" name="delete_post">';
                    echo '<input type="hidden" name="post_id" value="' . $p->post_id . '">';
                    echo '<input type="submit" name="delete_post" class="submit" value="Delete post">';
                    echo '</form>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-danger"><strong></strong>No posts found!</div>';
            }
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>Channel Overview</h1>
            <p>Here you can see all the channels.</p>

            <?php

            if ($channels->count()) {
                foreach ($channels->results() as $channel) {
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title">' . $channel->name . '</h4>';
                    echo '<p class="card-text">' . $channel->description . '</p>';
                    echo '<a href="posts.php?id=' . $channel->channel_id . '" class="btn btn-primary">View Channel</a>';
                    if ($channelpost = $channel->channel_id) {
                        $post_id = Input::get('post_id');
                        $post = Post::getPostById($post_id);
                        $posts = Post::getChannelPosts($channel->channel_id);                    
                        echo '<p class="card-text"><small class="text-muted">Antal posts ' . $posts->count()  . '</small></p>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-danger"><strong></strong>No channels found!</div>';
            }
            ?>


        </div>
    </div>
</div>
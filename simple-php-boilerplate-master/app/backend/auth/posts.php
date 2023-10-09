<?php
require_once 'app/backend/core/Init.php';

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (!Input::get('id')) {
    Redirect::to('index.php');
}

$data = $user->data();
$channel_id = Input::get('id');

$channel = Channel::getChannel($channel_id);
$posts = Post::getChannelPosts($channel_id);

if (Input::get('submit')) {

    Post::create($post);
    Redirect::to('channel.php?id=' . $channel_id);
}
if (Input::get('delete_post')) {
    $post_id = Input::get('post_id');
    $post = Post::getPostById($post_id);

    if ($post) {
        // Check if the user owns the post
        if ($post->user_id === $user->data()->uid) {
            // User owns the post, allow deletion
            $deleted = Post::deletePost($post_id);
            if ($deleted) {
                Session::flash('delete-post-success', 'Post deleted.');
            } else {
                Session::flash('delete-post-error', 'Post not found or not deleted.');
            }
        } else {
            // User does not own the post, deny deletion
            Session::flash('delete-post-error', 'You are not allowed to delete this post.');
        }
    } else {
        // Post not found
        Session::flash('delete-post-error', 'Post not found.');
    }

    Redirect::to('posts.php?id=' . $channel_id);
}

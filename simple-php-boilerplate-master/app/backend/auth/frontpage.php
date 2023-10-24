<?php
require_once 'app/backend/core/Init.php';

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$all = Frontpage::getAll();



$posts = array();

foreach ($all->results() as $post) {
    $tmp = array();
    $tmp['post_id'] = $post->post_id;
    $tmp['title'] = $post->title;
    $tmp['content'] = $post->content;
    $tmp['img_url'] = $post->img_url;
    $tmp['channel_id'] = $post->channel_id;
    $tmp['name'] = $post->name;
    $tmp['description'] = $post->description;
    
    //push into possts
    array_push($posts, $tmp);
}

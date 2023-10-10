<?php
require_once 'app/backend/core/Init.php';


// pull all posts in database
$posts = Post::getAllPosts();
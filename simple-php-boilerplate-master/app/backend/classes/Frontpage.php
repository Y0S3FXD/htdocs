<?php

class Frontpage
{

//  getallposts
    public static function getAllPosts()
    {
        $posts = Database::getInstance()->get('posts', array('post_id', '>', 0));
        //return list of posts
        return $posts;
    }



}
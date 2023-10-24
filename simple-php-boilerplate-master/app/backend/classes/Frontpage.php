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
    public static function getChannels()
    {
        $channels = Database::getInstance()->get('channels', array('channel_id', '>', '0'));
        //return list of channels
        return $channels;
    }

    public static function GetAll(){
        //Get all channels and their join on posts
        $channels = Database::getInstance()->query("SELECT * FROM channels LEFT JOIN posts ON channels.channel_id = posts.channel_id");
        return $channels;
    }
}
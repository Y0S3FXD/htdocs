<?php

class Post
{

    public static function create($fields = array())
    {
        if (!Database::getInstance()->insert('posts', $fields)) {
            throw new Exception("Unable to create the post.");
        }
    }

    public static function getAllPosts()
    {
        $posts = Database::getInstance()->get('posts', array('post_id', '>', '0'));
        //return list of posts
        return $posts;
    }

    public static function getChannelPosts($channel_id)
    {
        $posts = Database::getInstance()->get('posts', array('channel_id', '=', $channel_id));
        //return list of posts
        return $posts;
    }


    public static function getPostById($post_id)
    {
        $post = Database::getInstance()->get('posts', array('post_id', '=', $post_id));
        if ($post->count()) {
            return $post->first();
        }
    }
    public static function deletePost($post_id)
    {
        return Database::getInstance()->delete('posts', array('post_id', '=', $post_id));
    }

    public static function uploadImageToHostingService($imagepath)
    {
        $apikey = '6d207e02198a847aa98d0a2a901485a5';

        $apiurl = 'https://freeimage.host/api/1/upload';

        $requestData = [
            'key' => $apikey,
            'source' => $imagepath,
            'format' => 'json',
        ];

        if (file_exists($imagepath)&& is_readable($imagepath)){
            $requestData['source'] = new CURLFile($imagepath);
        } else {
            return false;
        }

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute the cURL request
        $response = curl_exec($ch);
    
        // Close cURL session
        curl_close($ch);
    
        // Parse the JSON response
        $responseData = json_decode($response, true);
    
        // Check if the response contains an image URL
        if (isset($responseData['image']['url'])) {
            return ['url' => $responseData['image']['url']];
        } else {
            return false; // Image upload failed or no URL in response
        }
    }
    }
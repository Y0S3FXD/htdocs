<?php
require_once 'app/backend/core/Init.php';

if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate = new Validation();

        $validation = $validate->check($_POST, array(
            'title' => array(
                'required' => true,
                'min' => 2,
                'max' => 25
            ),

            'content' => array(
                'required' => true,
                'min' => 2,
                'max' => 255,
            ),
        )); 

        if ($validate->passed()) {
            try {
                // Check if an image file was uploaded
                if (!empty($_FILES['post_image']['name'])) {
                    // Get the temporary image path
                    $imagePath = $_FILES['post_image']['tmp_name'];

                    // Upload the image to Freeimage.host
                    $imageInfo = Post::uploadImageToHostingService($imagePath);

                    if ($imageInfo !== false && isset($imageInfo['url'])) {
                        $imageURL = $imageInfo['url'];
                    } else {
                        echo '<div class="alert alert-danger"><strong>Error:</strong> Image upload failed.</div>';
                        // Handle the error as needed
                        exit();
                    }
                } else {
                    // No image was uploaded
                    $imageURL = ''; // Set a default image URL or leave it empty
                }

                // Create the post and include the image URL
                Post::create(array(
                    'title'  => Input::get('title'),
                    'content'  => Input::get('content'),
                    'img_url' => $imageURL, // Set the image URL here
                    'user_id' => $user->data()->uid,
                    'channel_id' => Input::get('channel_id'),
                ));

                Session::flash('create-post-success', 'Thanks for posting.');
                Redirect::to('posts.php?id=' . Input::get('channel_id'));
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $imagePath = $_FILES['post_image']['tmp_name'];

            var_dump($imagePath);
            foreach ($validate->errors() as $error) {
                echo '<div class="alert alert-danger"><strong></strong>' . cleaner($error) . '</div>';
            }
        }
    }
}

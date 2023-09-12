<?php
require_once 'app/backend/core/Init.php';

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (!Input::get('post_id')) {
    Redirect::to('index.php');
}
if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate = new Validation();

        $validation = $validate->check($_POST, array(
            'comment' => array(
                'required' => true,
                'min' => 2,
                'max' => 25
            ),
        )); 

        if ($validate->passed()) {
            try {
                Comment::create(array(
                    'comment_id'  => Input::get('comment_id'),
                    'user_id'      => $user->data()->uid,
                    'post_id'    => Input::get('post_id'),
                    'content'  => Input::get('comment')
                ));

                Session::flash('create-comment-success', 'Thanks for commenting.');
                Redirect::to('comments.php?post_id=' . Input::get('post_id'));
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo '<div class="alert alert-danger"><strong></strong>' . cleaner($error) . '</div>';
            }
        }
    }
}
$post_id = Input::get('post_id');
$post = Post::getPostById($post_id);


$comments = Comment::getAllComments($post_id);

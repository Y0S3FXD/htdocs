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
                'min' => 4,
                'max' => 100
            ),
        ));

        if ($validate->passed()) {
            try {
                Comment::create(array(
                    'user_id' => $user->data()->uid,
                    'post_id' => Input::get('post_id'),
                    'content' => Input::get('comment')
                ));

                Session::flash('create-comment-success', 'Thanks for commenting.');
                Redirect::to('comments.php?post_id=' . Input::get('post_id'));
            } catch (Exception $e) {
                // Handle the exception, e.g., log the error or display an error message to the user
                echo '<div class="alert alert-danger"><strong>Error: </strong>' . cleaner($e->getMessage()) . '</div>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo '<div class="alert alert-danger"><strong>Error: </strong>' . cleaner($error) . '</div>';
            }
        }
    }
}
if (Input::get('submit')) {
    $comment_id = Input::get('comment_id');
    var_dump($comment_id);
    $deleted = Comment::DeleteComment($comment_id);
    if ($deleted) {
        Session::flash('delete-comment-success', 'Comment deleted.');
    } else {
        Session::flash('delete-comment-error', 'Comment not found or not deleted.');
    }
    Redirect::to('comments.php?post_id=' . Input::get('post_id'));
} 

// Display success message if it exists
if (Session::exists('delete-comment-success')) {
    echo '<div class="alert alert-success"><strong>Success: </strong>' . Session::flash('delete-comment-success') . '</div>';
}

// Display error message if it exists
if (Session::exists('delete-comment-error')) {
    echo '<div class="alert alert-danger"><strong>Error: </strong>' . Session::flash('delete-comment-error') . '</div>';
}

$post_id = Input::get('post_id');
$post = Post::getPostById($post_id);

$comments = Comment::getAllComments($post_id);
$delete_comment = Input::get('delete_comment');
?>

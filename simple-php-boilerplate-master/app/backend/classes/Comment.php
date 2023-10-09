<?php

class Comment
{
    public static function create($fields = array())
    {
        if (!Database::getInstance()->insert('comments', $fields)) {
            throw new Exception("Unable to create the comment.");
        }
    }

    public static function getAllComments($post_id)
    {
        $comments = Database::getInstance()->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.uid WHERE post_id = ?", array($post_id));
        //return list of comments
        return $comments;
    }

    //i want to make delete comment
    public static function DeleteComment($comment_id)
    {
        $comment = Database::getInstance()->get('comments', array('comment_id', '=', $comment_id));
        if ($comment->count()) {
            // Attempt to delete the comment
            $deleted = Database::getInstance()->delete('comments', array('comment_id', '=', $comment_id));

            // Return true if the comment was deleted successfully, otherwise false
            return $deleted;
        }

        // Comment not found, return false
        return false;
    }


    public static function getCommentById($comment_id)
    {
        $comment = Database::getInstance()->get('comments', array('comment_id', '=', $comment_id));
        if ($comment->count()) {
            return $comment->first();
        }
    }
}

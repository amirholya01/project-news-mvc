<?php

namespace Admin;

use app\models\Comment as CommentModel;

class Comment extends Admin
{

    public function index()
    {
        $db = new CommentModel();
        $comments = $db->allWithRelations();
        require_once BASE_PATH . '/app/view/admin/comments/index.php';
    }

    public function changeStatus($id)
    {
        $db = new CommentModel();
        $comment = $db->find($id);
        if (empty($comment)) {
            $this->redirectBack();
        }
        if ($comment['status'] == 'seen') {
            $db->update($id, ['status' => 'approved']);
        } else {
            $db->update($id, ['status' => 'seen']);
        }
        $this->redirectBack();
    }

}

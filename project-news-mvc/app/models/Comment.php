<?php

namespace app\models;

class Comment extends Model
{

    public function all()
    {
        $banners = $this->select('SELECT * FROM comments ORDER BY `id` DESC');
        return $banners;
    }

    public function allWithRelations()
    {
        $banners = $this->select('SELECT comments.*, posts.title AS post_title, users.email AS email FROM comments LEFT JOIN posts ON comments.post_id = posts.id LEFT JOIN users ON comments.user_id = users.id ORDER BY `id` DESC');
        return $banners;
    }

    public function find($id)
    {
        $query = "SELECT * FROM `comments` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('comments', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('comments', $id, array_keys($values), $values);
    }

}

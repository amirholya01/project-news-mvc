<?php

namespace app\models;

class Post extends Model
{

    public function all()
    {
        $posts = $this->select('SELECT * FROM posts ORDER BY `id` DESC');
        return $posts;
    }

    public function allWithRelations()
    {
        $posts = $this->select('SELECT posts.*, categories.name AS category_name, users.email AS email FROM posts LEFT JOIN categories ON posts.cat_id = categories.id LEFT JOIN users ON posts.user_id = users.id ORDER BY `id` DESC');
        return $posts;
    }
    public function find($id)
    {
        $query = "SELECT * FROM `posts` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('posts', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('posts', $id, array_keys($values), $values);
    }

    public function delete($id)
    {
        $this->deleteMethod('posts', $id);
    }
}

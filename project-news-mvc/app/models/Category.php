<?php

namespace app\models;

class Category extends Model
{

    public function all()
    {
        $categories = $this->select('SELECT * FROM categories ORDER BY `id` DESC');
        return $categories;
    }

    public function find($id)
    {
        $query = "SELECT * FROM `categories` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('categories', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('categories', $id, array_keys($values), $values);
    }

    public function delete($id)
    {
        $this->deleteMethod('categories', $id);
    }
}

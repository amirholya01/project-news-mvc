<?php

namespace app\models;

class Menu extends Model
{

    public function all()
    {
        $menus = $this->select('SELECT * FROM menus ORDER BY `id` DESC');
        return $menus;
    }

    public function allWithRelations()
    {
        $posts = $this->select('SELECT m1.*, m2.name AS parent_name FROM menus m1 LEFT JOIN menus m2 ON m1.parent_id = m2.id ORDER BY id DESC');
        return $posts;
    }

    public function find($id)
    {
        $query = "SELECT * FROM `menus` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('menus', array_keys(array_filter($values)), array_filter($values));
    }

    public function update($id, $values)
    {
        $this->updateMethod('menus', $id, array_keys($values), $values);
    }

    public function delete($id)
    {
        $this->deleteMethod('menus', $id);
    }
}

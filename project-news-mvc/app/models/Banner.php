<?php

namespace app\models;

class Banner extends Model
{

    public function all()
    {
        $banners = $this->select('SELECT * FROM banners ORDER BY `id` DESC');
        return $banners;
    }

    public function find($id)
    {
        $query = "SELECT * FROM `banners` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('banners', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('banners', $id, array_keys($values), $values);
    }

    public function delete($id)
    {
        $this->deleteMethod('banners', $id);
    }
}

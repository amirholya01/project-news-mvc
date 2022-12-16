<?php

namespace app\models;

class Setting extends Model
{

    public function all()
    {
        $websetting = $this->select('SELECT * FROM websetting ORDER BY `id` DESC')->fetch();
        return $websetting;
    }

    public function find()
    {
        $query = "SELECT * FROM websetting";
        $result = $this->query($query)->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('websetting', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('websetting', $id, array_keys($values), $values);
    }

    public function delete($id)
    {
        $this->deleteMethod('websetting', $id);
    }
}

<?php

namespace app\models;

class User extends Model
{

    public function all()
    {
        $categories = $this->select('SELECT * FROM users ORDER BY `id` DESC');
        return $categories;
    }
    public function find($id)
    {
        $query = "SELECT * FROM `users` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        return $result;
    }
    public function findByEmail($email)
    {
        $query = "SELECT * FROM `users` WHERE email = ? ";
        $result = $this->query($query, array($email))->fetch();
        return $result;
    }
    public function findByToken($token)
    {
        $query = "SELECT * FROM `users` WHERE verify_token = ? AND is_active = 0 ";
        $result = $this->query($query, array($token))->fetch();
        return $result;
    }
    public function findByForgotToken($token)
    {
        $query = "SELECT * FROM `users` WHERE forgot_token = ? ";
        $result = $this->query($query, array($token))->fetch();
        return $result;
    }
    public function findBySession($session)
    {
        $query = "SELECT * FROM `users` WHERE id = ? ";
        $result = $this->query($query, array($session))->fetch();
        return $result;
    }

    public function insert($values)
    {
        $this->insertMethod('users', array_keys($values), $values);
    }

    public function update($id, $values)
    {
        $this->updateMethod('users', $id, array_keys($values), $values);

    }

    public function delete($id)
    {
        $this->deleteMethod('users', $id);
    }
}

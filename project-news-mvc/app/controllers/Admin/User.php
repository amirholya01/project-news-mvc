<?php

namespace Admin;

use app\models\User as userModel;

class User extends Admin
{

    public function index()
    {
        $db = new userModel();
        $users = $db->all();
        require_once BASE_PATH . '/app/view/admin/users/index.php';
    }

    public function edit($id)
    {
        $db = new userModel();
        $user = $db->find($id);
        require_once BASE_PATH . '/app/view/admin/users/edit.php';
    }

    public function update($request, $id)
    {
        $db = new userModel();
        $request = ['username' => $request['username'], 'permission' => $request['permission']];
        $db->update($id, $request);
        $this->redirect('admin/user');

    }

    public function delete($id)
    {
        $db = new userModel();
        $db->delete($id);
        $this->redirect('admin/user');
    }

    public function permission($id)
    {
        $db = new userModel();
        $user = $db->find($id);
        if (empty($user)) {
            $this->redirectBack();
        }
        if ($user['permission'] == 'user') {
            $db->update($id, ['permission' => 'admin']);
        } else {
            $db->update($id, ['permission' => 'user']);
        }
        $this->redirectBack();
    }
}

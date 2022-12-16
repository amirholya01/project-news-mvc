<?php

namespace Admin;

use app\models\Menu as MenuModel;
use database\Database;

class Menu extends Admin
{

    public function index()
    {
        $db = new MenuModel();
        $menus = $db->allWithRelations();
        require_once BASE_PATH . '/app/view/admin/menus/index.php';
    }

    public function create()
    {
        $db = new MenuModel();
        $menus = $db->all();
        require_once BASE_PATH . '/app/view/admin/menus/create.php';
    }

    public function store($request)
    {
        $db = new MenuModel();
        $db->insert($request);
        $this->redirect('admin/menu');
    }

    public function edit($id)
    {
        $db = new MenuModel();
        $menu = $db->find($id);
        $menus = $db->all();
        require_once BASE_PATH . '/app/view/admin/menus/edit.php';
    }

    public function update($request, $id)
    {
        $db = new MenuModel();
        $db->update($id, $request);
        $this->redirect('admin/menu');

    }

    public function delete($id)
    {
        $db = new MenuModel();
        $db->delete($id);
        $this->redirect('admin/menu');
    }
}

<?php

namespace Admin;

use app\models\Category as CategoryModel;

class Category extends Admin
{

    public function index()
    {
        $db = new CategoryModel();
        $categories = $db->all();
        require_once BASE_PATH . '/app/view/admin/categories/index.php';
    }

    public function create()
    {
        require_once BASE_PATH . '/app/view/admin/categories/create.php';
    }

    public function store($request)
    {
        $db = new CategoryModel();
        $db->insert($request);
        $this->redirect('admin/category');
    }

    public function edit($id)
    {
        $db = new CategoryModel();
        $category = $db->find($id);
        require_once BASE_PATH . '/app/view/admin/categories/edit.php';
    }

    public function update($request, $id)
    {
        $db = new CategoryModel();
        $db->update($id, $request);
        $this->redirect('admin/category');

    }

    public function delete($id)
    {
        $db = new CategoryModel();
        $db->delete($id);
        $this->redirect('admin/category');
    }
}

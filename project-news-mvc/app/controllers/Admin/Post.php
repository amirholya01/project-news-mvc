<?php

namespace Admin;

use Admin\Admin;
use app\models\Category;
use app\models\Post as PostModel;
use app\models\User;

class Post extends Admin
{

    public function index()
    {
        $db = new PostModel();
        $posts = $db->allWithRelations();
        require_once BASE_PATH . '/app/view/admin/posts/index.php';
    }

    public function create()
    {
        $db = new Category();
        $categories = $db->all();
        require_once BASE_PATH . '/app/view/admin/posts/create.php';

    }

    public function store($request)
    {
        $db = new PostModel();
        if ($request['cat_id'] != null) {
            $request['image'] = $this->saveImage($request['image'], 'post-image');
            if ($request['image']) {
                $dbUser = new User();
                $user = $dbUser->findBySession($_SESSION['user']);
                $request = array_merge($request, ['user_id' => $user['id']]);
                $db->insert($request);
                $this->redirect('admin/post');
            } else {
                $this->redirect('admin/post');
            }
        } else {
            $this->redirect('admin/post');
        }
    }

    public function edit($id)
    {
        $dbPost = new PostModel();
        $post = $dbPost->find($id);
        $dbCategory = new Category();
        $categories = $dbCategory->all();
        require_once BASE_PATH . '/app/view/admin/posts/edit.php';
    }

    public function update($request, $id)
    {
        $db = new PostModel();
        if ($request['cat_id'] != null) {
            if ($request['image']['tmp_name'] != null) {
                $post = $db->find($id);
                $this->removeImage($post['image']);
                $request['image'] = $this->saveImage($request['image'], 'post-image');
            } else {
                unset($request['image']);
            }
            $db->update($id, $request);
            $this->redirect('admin/post');
        } else {
            $this->redirect('admin/post');
        }

    }

    public function delete($id)
    {

        $db = new PostModel();
        $post = $db->find($id);
        $this->removeImage($post['image']);
        $db->delete($id);
        $this->redirectBack();
    }

    public function selected($id)
    {

        $db = new PostModel();
        $post = $db->find($id);
        if (empty($post)) {
            $this->redirectBack();
        }
        if ($post['selected'] == 1) {
            $db->update($id, ['selected' => 2]);
        } else {
            $db->update($id, ['selected' => 1]);
        }
        $this->redirectBack();
    }

    public function breakingNews($id)
    {
        $db = new PostModel();
        $post = $db->find($id);
        if (empty($post)) {
            $this->redirectBack();
        }
        if ($post['breaking_news'] == 1) {
            $db->update($id, ['breaking_news' => 2]);
        } else {
            $db->update($id, ['breaking_news' => 1]);
        }
        $this->redirectBack();
    }
}

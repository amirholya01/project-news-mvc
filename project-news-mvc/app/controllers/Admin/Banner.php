<?php

namespace Admin;

use app\models\Banner as BannerModel;

class Banner extends Admin
{

    public function index()
    {
        $db = new BannerModel();
        $banners = $db->all();
        require_once BASE_PATH . '/app/view/admin/banners/index.php';
    }

    public function create()
    {

        require_once BASE_PATH . '/app/view/admin/banners/create.php';

    }

    public function store($request)
    {
        $db = new BannerModel();
        $request['image'] = $this->saveImage($request['image'], 'banner-image');
        if ($request['image']) {
            $db->insert($request);
            $this->redirect('admin/banner');
        } else {
            $this->redirect('admin/banner');
        }

    }

    public function edit($id)
    {
        $db = new BannerModel();
        $banner = $db->find($id);
        require_once BASE_PATH . '/app/view/admin/banners/edit.php';
    }

    public function update($request, $id)
    {
        $db = new BannerModel();
        {
            if ($request['image']['tmp_name'] != null) {
                $banner = $db->find($id);
                $this->removeImage($banner['image']);
                $request['image'] = $this->saveImage($request['image'], 'banner-image');
            } else {
                unset($request['image']);
            }
            $db->update($id, $request);
            $this->redirect('admin/banner');
        }

    }

    public function delete($id)
    {
        $db = new BannerModel();
        $banner = $db->find($id);
        $this->removeImage($banner['image']);
        $db->delete($id);
        $this->redirectBack();
    }
}

<?php

namespace Admin;

use app\models\Setting;

class Websetting extends Admin
{

    public function index()
    {
        $db = new Setting();
        $websetting = $db->all();
        require_once BASE_PATH . '/app/view/admin/websetting/index.php';
    }

    public function edit()
    {
        $db = new Setting();
        $websetting = $db->find();
        require_once BASE_PATH . '/app/view/admin/websetting/edit.php';
    }

    public function update($request)
    {
        $db = new Setting();
        $websetting = $db->find();
        if ($request['logo']['tmp_name'] != '') {
            $request['logo'] = $this->saveImage($request['logo'], 'setting', 'logo');
        } else {
            unset($request['logo']);
        }
        if ($request['icon']['tmp_name'] != '') {
            $request['icon'] = $this->saveImage($request['icon'], 'setting', 'icon');
        } else {
            unset($request['icon']);
        }
        if (!empty($websetting)) {
            $db->update($websetting['id'], $request);
        } else {
            $db->insert($request);
        }
        $this->redirect('admin/websetting');

    }

}

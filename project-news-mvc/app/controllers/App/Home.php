<?php

namespace App;

use app\models\Banner;
use app\models\Category;
use app\models\Comment;
use app\models\Menu;
use app\models\Post;
use app\models\Setting;

class Home
{

    public function index()
    {
        $dbSetting = new Setting();
        $setting = $dbSetting->find();

        $dbMenu = new Menu();
        $menus = $dbMenu->all();

        $dbPost = new Post();
        $topSelectedPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts WHERE posts.selected = 1 ORDER BY created_at DESC LIMIT 0,3')->fetchAll();

        $breakingNews = $dbPost->select('SELECT * FROM posts WHERE breaking_news = 1 ORDER BY created_at DESC LIMIT 0,1')->fetch();

        $lastPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY created_at DESC LIMIT 0,6')->fetchAll();

        $dbBanner = new Banner();
        $bodyBanner = $dbBanner->select('SELECT * FROM banners LIMIT 0,1')->fetch();

        $sidebarBanner = $dbBanner->select('SELECT * FROM banners LIMIT 0,1')->fetch();

        $popularPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY view DESC LIMIT 0,3')->fetchAll();

        $mostCommentPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY comments_count DESC LIMIT 0,3')->fetchAll();

        require_once BASE_PATH . '/app/view/app/index.php';
    }

    public function show($id)
    {
        $dbSetting = new Setting();
        $setting = $dbSetting->find();

        $dbMenu = new Menu();
        $menus = $dbMenu->all();

        $dbPost = new Post();

        $dbBanner = new Banner();
        $sidebarBanner = $dbBanner->select('SELECT * FROM banners LIMIT 0,1')->fetch();

        $mostCommentPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY comments_count DESC LIMIT 0,3')->fetchAll();
        $topSelectedPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts WHERE posts.selected = 1 ORDER BY created_at DESC LIMIT 0,1')->fetchAll();

        $post = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts WHERE id = ?', [$id])->fetch();

        $dbPost->update($id, ['view' => $post['view'] + 1]);

        $dbComments = new Comment();
        $comments = $dbComments->select('SELECT *, (SELECT username FROM users WHERE users.id = comments.user_id) AS username FROM comments WHERE post_id = ? AND status = "approved"', [$id])->fetchAll();

        require_once BASE_PATH . '/app/view/app/show.php';

    }

    public function category($id)
    {
        $dbSetting = new Setting();
        $setting = $dbSetting->find();

        $dbMenu = new Menu();
        $menus = $dbMenu->all();

        $dbPost = new Post();

        $dbBanner = new Banner();
        $sidebarBanner = $dbBanner->select('SELECT * FROM banners LIMIT 0,1')->fetch();
        $bodyBanner = $dbBanner->select('SELECT * FROM banners LIMIT 0,1')->fetch();

        $dbCategory = new Category();
        $category = $dbCategory->select("SELECT * FROM categories WHERE id = ?", [$id])->fetch();
        $topSelectedPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts WHERE posts.selected = 1 ORDER BY created_at DESC LIMIT 0,1')->fetchAll();
        $popularPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY view DESC LIMIT 0,3')->fetchAll();
        $breakingNews = $dbPost->select('SELECT * FROM posts WHERE breaking_news = 1 ORDER BY created_at DESC LIMIT 0,1')->fetch();
        $mostCommentPosts = $dbPost->select('SELECT  posts.*, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts ORDER BY comments_count DESC LIMIT 0,3')->fetchAll();
        $categoryPosts = $dbPost->select('SELECT posts.*,(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count, (SELECT username FROM users WHERE users.id = posts.user_id) AS username, (SELECT name FROM categories WHERE categories.id = posts.cat_id) AS category FROM posts WHERE cat_id = ? ORDER BY created_at DESC LIMIT 0,6', [$id])->fetchAll();
        require_once BASE_PATH . '/app/view/app/category.php';

    }

    public function commentStore($request, $post_id)
    {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] != null) {
                $db = new Comment();
                $db->insert(['user_id' => $_SESSION['user'], 'post_id' => $post_id, 'comment' => $request['comment']]);
                $this->redirectBack();
            } else {
                $this->redirectBack();
            }
        } else {
            $this->redirectBack();
        }

    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}

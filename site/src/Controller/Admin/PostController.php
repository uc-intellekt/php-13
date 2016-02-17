<?php

namespace Controller\Admin;

use Doctrine\DBAL\Connection as Conn;
use Silex\Application as App;

class PostController
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function indexAction()
    {
        $posts = $this->getDb()->fetchAll('SELECT * FROM post');

        return $this->getTwig()->render('admin/post/index.twig', array(
            'posts' => $posts,
        ));
    }

    public function editAction($id)
    {
        $id = (int)$id;

        $post = $this->getDb()->fetchAssoc("SELECT *
            FROM post
            WHERE 1
                AND id = :id
                AND published = 1
            LIMIT 1
        ", [
            'id' => $id,
        ]);
        if (!$post) {
            $this->app->abort(404, "Post $id does not exist.");
        }

        return $this->getTwig()->render('admin/post/edit.twig', array(
            'post' => $post,
        ));
    }

    /**
     * @return Conn
     */
    private function getDb()
    {
        return $this->app['db'];
    }

    /**
     * @return \Twig_Environment
     */
    private function getTwig()
    {
        return $this->app['twig'];
    }
}

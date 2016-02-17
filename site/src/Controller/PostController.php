<?php

namespace Controller;

use Doctrine\DBAL\Connection as Conn;
use Silex\Application as App;

class PostController
{
    private $app;

    public function init(App $app)
    {
        $this->app = $app;
    }

    public function indexAction(App $app)
    {
        $this->init($app);

        $posts = $this->getDb()->fetchAll('SELECT * FROM post WHERE published = 1');

        return $this->getTwig()->render('post/index.twig', array(
            'posts' => $posts,
        ));
    }

    public function showAction(App $app, $id)
    {
        $this->init($app);
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
            $app->abort(404, "Post $id does not exist.");
        }

        return $this->getTwig()->render('post/show.twig', array(
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

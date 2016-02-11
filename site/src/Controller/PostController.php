<?php

namespace Controller;

use Doctrine\DBAL\Connection as Conn;
use Silex\Application as App;

class PostController
{
    public function indexAction(App $app)
    {
        /** @var Conn $db */
        $db = $app['db'];

        $posts = $db->fetchAll('SELECT * FROM post');
        var_dump($posts); die;
    }

    public function showAction(App $app, $id)
    {
        /** @var Conn $db */
        $db = $app['db'];

        $post = $db->fetchAssoc("SELECT *
            FROM post
            WHERE id = :id
            LIMIT 1
        ", [
            'id' => $id,
        ]);
        var_dump($post); die;
    }
}

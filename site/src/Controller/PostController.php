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
        /** @var \Twig_Environment $twig */
        $twig = $app['twig'];

        $posts = $db->fetchAll('SELECT * FROM post WHERE published = 1');

        return $twig->render('post/index.twig', array(
            'posts' => $posts,
        ));
    }

    public function showAction(App $app, $id)
    {
        $id = (int)$id;
        /** @var Conn $db */
        $db = $app['db'];
        /** @var \Twig_Environment $twig */
        $twig = $app['twig'];

        $post = $db->fetchAssoc("SELECT *
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

        return $twig->render('post/show.twig', array(
            'post' => $post,
        ));
    }
}

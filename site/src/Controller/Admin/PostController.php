<?php

namespace Controller\Admin;

use Doctrine\DBAL\Connection as Conn;
use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;

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

    public function newAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->getDb()->insert('post', [
                'heading' => $request->request->get('heading'),
                'content' => $request->request->get('content'),
            ]);
            $id = $this->getDb()->lastInsertId();

            $redirectUrl = $this->generateUrl('admin_post_edit', [
                'id' => $id,
            ]);

            return $this->app->redirect($redirectUrl);
        }

        return $this->getTwig()->render('admin/post/new.twig');
    }

    public function editAction(Request $request, $id)
    {
        $id = (int)$id;

        if ($request->isMethod('POST')) {
//            var_dump($request->request->all());
            $this->getDb()->update('post', [
                'heading' => $request->request->get('heading'),
                'content' => $request->request->get('content'),
            ], [
                'id' => $id,
            ]);

            $redirectUrl = $this->generateUrl('admin_post_edit', [
                'id' => $id,
            ]);

            return $this->app->redirect($redirectUrl);
        }

        $post = $this->getDb()->fetchAssoc("SELECT *
            FROM post
            WHERE 1
                AND id = :id
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

    /**
     * @return UrlGenerator
     */
    private function getUrlGenerator()
    {
        return $this->app['url_generator'];
    }

    /**
     * @param string $name
     * @param array $parameters
     * @param int $referenceType
     *
     * @return string
     */
    private function generateUrl($name, $parameters = [], $referenceType = UrlGenerator::ABSOLUTE_PATH)
    {
        return $this->getUrlGenerator()->generate($name, $parameters, $referenceType);
    }
}

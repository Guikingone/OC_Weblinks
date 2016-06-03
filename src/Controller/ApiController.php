<?php

namespace WebLinks\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Weblinks\Domain\Link;

class ApiController {

    /**
     * API links controller.
     *
     * @param Application $app Silex application
     *
     * @return All links in JSON format
     */
    public function getLinksAction(Application $app) {
        $links = $app['dao.link']->findAll();
        $responseData = array();
        foreach ($links as $link) {
            $responseData[] = $this->buildLinkArray($link);
        }
        return $app->json($responseData);
    }

    /**
     * API link details controller.
     *
     * @param integer $id Link id
     * @param Application $app Silex application
     *
     * @return Link details in JSON format
     */
    public function getLinkAction($id, Application $app) {
        $link = $app['dao.link']->find($id);
        $responseData = $this->buildLinkArray($link);
        return $app->json($responseData);
    }

    /**
     * API create links controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return Link details in JSON format
     */
    public function addLinkAction(Request $request, Application $app) {
        if (!$request->request->has('title')) {
            return $app->json('Missing required parameter: title', 400);
        }
        if (!$request->request->has('content')) {
            return $app->json('Missing required parameter: content', 400);
        }
        $link = new Link();
        $link->setTitle($request->request->get('title'));
        $link->setUrl($request->request->get('content'));
        $app['dao.article']->save($link);
        $responseData = $this->buildLinkArray($link);
        return $app->json($responseData, 201);  // 201 = Created
    }

    /**
     * API delete link controller.
     *
     * @param integer $id Link id
     * @param Application $app Silex application
     */
    public function deleteLinkAction($id, Application $app) {
        $app['dao.link']->delete($id);
        return $app->json('No Content', 204);
    }

    /**
     * Converts an Link object into an associative array for JSON encoding
     *
     * @param Link $link Link object
     *
     * @return array Associative array whose fields are the link properties.
     */
    private function buildLinkArray(Link $link) {
        $data  = array(
            'id' => $link->getId(),
            'title' => $link->getTitle(),
            'content' => $link->getUrl()
        );
        return $data;
    }
}
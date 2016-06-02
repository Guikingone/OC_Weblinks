<?php

use Symfony\Component\HttpFoundation\Request;
use Weblinks\Domain\Link;
use WebLinks\Form\Type\LinkType;


// Home page
$app->get('/', function () use ($app) {
    $links = $app['dao.link']->findAll();
    return $app['twig']->render('index.html.twig', array('links' => $links));
})->bind('/');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Admin home page
$app->get('/admin', function() use ($app) {
    $links = $app['dao.link']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'link' => $links,
        'users' => $users));
})->bind('admin');

// Add a new link
$app->match('/admin/link/add', function(Request $request) use ($app) {
    $link = new Link();
    $linkForm = $app['form.factory']->create(new LinkType(), $link);
    $linkForm->handleRequest($request);
    if ($linkForm->isSubmitted() && $linkForm->isValid()) {
        $app['dao.link']->save($link);
        $app['session']->getFlashBag()->add('success', 'The link was successfully created.');
    }
    return $app['twig']->render('link_form.html.twig', array(
        'title' => 'New link',
        'linkForm' => $linkForm->createView()));
})->bind('admin_link_add');

// Edit a link
$app->match('/admin/link/{id}/edit', function($id, Request $request) use ($app) {
    $link = $app['dao.link']->find($id);
    $linkForm = $app['form.factory']->create(new linkType(), $link);
    $linkForm->handleRequest($request);
    if ($linkForm->isSubmitted() && $linkForm->isValid()) {
        $app['dao.link']->save($link);
        $app['session']->getFlashBag()->add('success', 'The link was succesfully updated.');
    }
    return $app['twig']->render('link_form.html.twig', array(
        'title' => 'Edit link',
        'linkForm' => $linkForm->createView()));
})->bind('admin_link_edit');

// Remove a link
$app->get('/admin/link/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.link']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The link was succesfully removed.');
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_link_delete');
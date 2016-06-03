<?php
/**
 *  This file is a part of the routing module of the WebLinks Application, the content created here is purely optionnal
 *  and depend on the need of the user, in order to add a new route, start by call the method followed by the prefix,
 *  the namespace of the controller and finally the Action, the bind part let the user use the path() method on the views.
 *
 *  Created By Guillaume Loulier <guillaume.loulier[at]hotmail.fr
 *
 *  Last update the 03/06/2016
 */


// Home page
$app->get('/', "WebLinks\Controller\HomeController::indexAction")->bind('home');

// Detailed info about a link
$app->match('/link/{id}', "WebLinks\Controller\HomeController::linkAction")->bind('link');

// Submit a link
$app->match('/submit', "WebLinks\Controller\AdminController::submitLinkAction")->bind('link_submit');

// Login form
$app->get('/login', "WebLinks\Controller\HomeController::loginAction")->bind('login');

// Admin page
$app->get('/admin', "WebLinks\Controller\AdminController::indexAction")->bind('admin');

// Add a new link
$app->match('/admin/link/add', "WebLinks\Controller\AdminController::addLinkAction")->bind('admin_link_add');

// Edit a link
$app->match('/admin/link/{id}/edit', "WebLinks\Controller\AdminController::editLinkAction")->bind('admin_link_edit');

// Remove a link
$app->get('/admin/link/{id}/delete', "WebLinks\Controller\AdminController::deleteLinkAction")->bind('admin_link_delete');

// Add a user
$app->match('/admin/user/add', "WebLinks\Controller\AdminController::addUserAction")->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "WebLinks\Controller\AdminController::editUserAction")->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "WebLins\Controller\AdminController::deleteUserAction")->bind('admin_user_delete');

// API : get all links
$app->get('/api/links', "WebLinks\Controller\ApiController::getLinksAction")->bind('api_links');

// API : get a link
$app->get('/api/link/{id}', "Weblinks\Controller\ApiController::getLinkAction")->bind('api_link');

// API : create a link
$app->post('/api/link', "Weblinks\Controller\ApiController::addLinkAction")->bind('api_link_add');

// API : remove a link
$app->delete('/api/link/{id}', "Weblinks\Controller\ApiController::deleteLinkAction")->bind('api_link_delete');

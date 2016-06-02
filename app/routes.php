<?php

// Home page
$app->get('/', "WebLinks\Controller\HomeController::indexAction")->bind('home');

// Detailed info about a link
$app->match('/link/{id}', "WebLinks\Controller\HomeController::linkAction")->bind('link');

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

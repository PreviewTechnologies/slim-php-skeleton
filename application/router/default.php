<?php

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    /** @var Dummy $this */
    return $this->view->render($response, 'home.twig');
})->add(new \Previewtechs\Framework\PHP\SlimSkeleton\Utility\Middleware\Auth());

$app->get('/login', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    /** @var Dummy $this */
    return $this->view->render($response, 'login.twig');
});

$app->get('/logout', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    /** @var Dummy $this */
    return $response->withRedirect('/login');
});

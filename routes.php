<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/join', 'join.php');

$processController = "/requests/processForms.php";

$router->post('/', $processController);
$router->post('/about', $processController);
$router->post('/join', $processController);
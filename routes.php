<?php

$router->get('/', 'index.php');
$router->post('/', "/requests/processForms.php");
$router->get('/our-home', 'our-home.php');
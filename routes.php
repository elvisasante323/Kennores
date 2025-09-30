<?php

$router->get('/', 'index.php');
$router->post('/', "/requests/processForms.php");
<?php
    require_once("config.php");

    $url = (isset($_GET['url'])) ? $_GET['url'] : 'Index/index';
    $url = explode ("/", $url);
    $controller = array_shift($url);
    $method = array_shift($url);
    $params = array($url);
    echo "here" . $controller . $method . $params;

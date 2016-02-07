<?php

    $url = $_GET['url'];
    var_dump($url);
/*
    require_once("config.php");

    $url = (isset($_GET['url'])) ? $_GET['url'] : 'Index/lol/dfg';
    $url = explode ("/", $url);
    $controller = array_shift($url);
    $method = array_shift($url);
    $params = $url;
    echo dirname(__FILE__);
    echo "heresad" . $controller . $method ;*/

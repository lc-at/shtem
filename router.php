<?php
$config = include('config.php');
if (!php_sapi_name() == 'cli-server') {
    die('This is a router file. Meant to be used with PHP Development Server.');
} elseif (preg_match('~^/static~', $_SERVER['REQUEST_URI'])) {
    return false;
} elseif (preg_match('~^/get/([a-z0-9]+)$~', $_SERVER['REQUEST_URI'], $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'get_mem_item.php';
} elseif (preg_match('~^/([a-z0-9]*)~', $_SERVER['REQUEST_URI'], $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'index.php';
} else {
    die('404 not found');
}

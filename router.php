<?php
$config = include('config.php');
if (!php_sapi_name() == 'cli-server') {
    die('This is a router file. Meant to be used with PHP Development Server.');
} elseif (preg_match('~^/static~', $_SERVER['REQUEST_URI'])) {
    return false;
} elseif (preg_match(sprintf('~^/get/([%s]+)$~', $config->mname_valid_chars), $_SERVER['REQUEST_URI'], $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'get.php';
} elseif (preg_match(sprintf('~^/([%s]*)~', $config->mname_valid_chars), $_SERVER['REQUEST_URI'], $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'index.php';
} else {
    die('404 not found');
}

<?php
$config = include('config.php');
$request_uri = substr($_SERVER['REQUEST_URI'], strlen($config->base_url));
if (preg_match(sprintf('~^get/([%s]+)$~', $config->mname_valid_chars), $request_uri, $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'get.php';
} elseif (preg_match(sprintf('~^([%s]*)~', $config->mname_valid_chars), $request_uri, $match)) {
    $_GET[$config->mname_param_name] = $match[1];
    include 'store.php';
} else {
    die('404 not found');
}

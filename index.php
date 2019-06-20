<?php
$config = include('config.php');
if (count($_POST) > 0 || count($_GET) > 1) {
    header('Content-Type: application/json');
    $memory = array_merge($_GET, $_POST);
    $mname = $config->mname_prefix;
    $valid_mname_re = sprintf('~^[%s]+~', $config->mname_valid_chars);
    if (
        isset($memory[$config->mname_param_name])
        && preg_match($valid_mname_re, $memory[$config->mname_param_name])
    ) {
        $mname .= $memory[$config->mname_param_name];
        unset($memory[$config->mname_param_name]);
    } else {
        $clean_mname_re = sprintf('~[^%s]+~', $config->mname_valid_chars);
        $mname .= preg_replace($clean_mname_re, '', strtolower($_SERVER['REMOTE_ADDR']));
    }
    $fcontent = json_encode($memory);
    $resp = array(
        'ok'     => true,
        'mname'  => substr($mname, strlen($config->mname_prefix)),
        'length' => strlen($fcontent)
    );
    if (strlen($fcontent) > $config->memory_max_len)
        $resp['ok'] = false;
    else
        file_put_contents($config->memory_items_dir . $mname, json_encode($memory));
    echo json_encode($resp);
} else {
    include 'help.html';
}

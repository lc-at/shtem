<?php
$config = include('config.php');
if ($handle = opendir($config->memory_items_dir)) {
    while (false !== ($file = readdir($handle))) {
        $path = $config->memory_items_dir . $file;
        if (
            preg_match(sprintf('~^%s~', $config->mname_prefix), $file)
            && filectime($path) < (time() - $config->memory_item_ttl)
        ) {
            unlink($path);
        }
    }
}
if (count($_POST) > 0 || count($_GET) > 1 || !empty($_FILES)) {
    header('Content-Type: application/json');
    $memory = array_merge($_GET, $_POST);
    $memory_len = strlen(serialize((array)$memory));
    if (!empty($_FILES)) {
        foreach ($_FILES as $pname => $file) {
            if ($file['error'] == UPLOAD_ERR_OK && $memory_len <= $config->memory_max_len) {
                $memory_len += $file['size'];
                $memory[$pname] = file_get_contents($file['tmp_name']);
            }
        }
    }
    $mname = $config->mname_prefix;
    $valid_mname_re = sprintf('~^[%s]+~', $config->mname_valid_chars);
    if (
        isset($memory[$config->mname_param_name])
        && preg_match($valid_mname_re, $memory[$config->mname_param_name])
    ) {
        $mname .= $memory[$config->mname_param_name];
    } else {
        $clean_mname_re = sprintf('~[^%s]+~', $config->mname_valid_chars);
        $mname .= preg_replace($clean_mname_re, '', strtolower($_SERVER['REMOTE_ADDR']));
    }
    if (isset($memory[$config->mname_param_name]))
        unset($memory[$config->mname_param_name]);
    $fcontent = json_encode($memory);
    $resp = array(
        'ok'     => true,
        'mname'  => substr($mname, strlen($config->mname_prefix)),
        'length' => strlen($fcontent)
    );
    if ($memory_len > $config->memory_max_len)
        $resp['ok'] = false;
    else
        file_put_contents($config->memory_items_dir . $mname, json_encode($memory));
    echo json_encode($resp);
} else {
    include 'help.html';
}

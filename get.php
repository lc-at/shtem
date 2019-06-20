<?php
header('Content-Type: application/json');
$config = include('config.php');
$valid_mname_re = sprintf('~^[%s]+$~', $config->mname_valid_chars);
$resp = array('ok' => true, 'memory' => array());
if (
    isset($_GET[$config->mname_param_name])
    && preg_match($valid_mname_re, $_GET[$config->mname_param_name])
) {
    $fpath = $config->memory_items_dir . $config->mname_prefix . $_GET[$config->mname_param_name];
    if (!file_exists($fpath)) {
        $resp['ok'] = false;
    } else {
        $fcontent = file_get_contents($fpath);
        $resp['memory'] = json_decode($fcontent);
    }
} else {
    $resp['ok'] = false;
}
echo json_encode($resp, JSON_PRETTY_PRINT);

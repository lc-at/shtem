<?php
return (object)array(
    'memory_item_ttl'   => 120,
    'memory_items_dir'  => sys_get_temp_dir() . DIRECTORY_SEPARATOR,
    'mname_prefix'      => 'shtem_',
    'mname_param_name'  => '____shtem_mname____',
    'memory_max_len'    => 25 * 1000,
    'mname_valid_chars' => 'a-z0-9'
);

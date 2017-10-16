<?php

$id = 'DB_SCHEMA';

$options = [
    'cacheDir' => CACHE_DIR
];

$cache = new Lazy\Cache($options);
$data = unserialize($cache->get($id));

var_dump($data);

?>

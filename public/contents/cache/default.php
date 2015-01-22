<?php

$id = 'DB_SCHEMA';

$options = [
    'cacheDir' => '_tmp/'
];

$cache = new Lazy\Cache($options);
$data = $cache->get($id);

$app->json_encode(unserialize($data));

?>

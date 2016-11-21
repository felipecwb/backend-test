<?php

$this->addController('HomeController');
$this->get('/', 'controller.home:indexPage');

$this->get('/assets/all.js', function () {
    return file_get_contents(__DIR__ . '/../public/assets/all.js');
});
$this->get('/assets/styles.css', function () {
    return file_get_contents(__DIR__ . '/../public/assets/styles.css');
});

$this->mount('/api', function ($api) {
    $this->addController('PositionController');

    $api->get('/position', 'controller.position:find');
    $api->get('/position/locations', 'controller.position:locations');
});

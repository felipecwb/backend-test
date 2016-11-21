<?php

$this->addController('HomeController');
$this->get('/', 'controller.home:indexPage');

$this->mount('/api', function ($api) {
    $this->addController('PositionController');

    $api->get('/position', 'controller.position:find');
    $api->get('/position/locations', 'controller.position:locations');
});

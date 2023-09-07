<?php

use Rareloop\Lumberjack\Facades\Router;

Router::get('search', function () {
    require('search.php');

    return (new App\SearchController())->handle();
});

// style guide
Router::get('component-test', function () {
    $context = Timber::context();
    return Timber::compile('/templates/component-test.twig', $context);
});

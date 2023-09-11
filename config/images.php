<?php

return [
    'imgix_debug' => $_ENV['IMGIX_DEBUG'] === "true",

    'imgix_host' => $_ENV['IMGIX_HOST'],

    'imgix_host_transforms' => array_combine(
        explode(',', $_ENV['IMGIX_TRANSFORM_SOURCES']),
        explode(',', $_ENV['IMGIX_TRANSFORM_HOSTS'])
    ),

    /**
     * List of image sizes to register, each image size looks like:
     *     [
     *         'name' => 'thumb'
     *         'width' => 100,
     *         'height' => 200,
     *         'crop' => true,
     *     ]
     */
    'sizes' => [
    ],
];

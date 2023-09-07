<?php

require get_theme_root() . '/' . get_template() . '/vendor/autoload.php';

use App\Http\Lumberjack;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create the Application Container
$app = require_once('bootstrap/app.php');

// Bootstrap Lumberjack from the Container
$lumberjack = $app->make(Lumberjack::class);
$lumberjack->bootstrap();

// Import our routes file
require_once('routes.php');

// Set global params in the Timber context
add_filter('timber_context', [$lumberjack, 'addToContext']);

function humanDateRanges($start, $end)
{
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    $divider = '-';

    if (date('Y', $startTime) != date('Y', $endTime)) {
        // diff years
        $start = date('F j, Y', $startTime);
        $end = date('F j, Y', $endTime);
    } else {
        // same years
        $start = date('jS F', $startTime);
        $end = date('jS F Y', $endTime);

        // same months
        if (date('m', $startTime) == date('m', $endTime)) {
            $start = date('jS', $startTime);

            // same days
            if (date('d', $startTime) == date('d', $endTime)) {
                return date('jS F Y', $startTime);
            }
        }
    }

    return sprintf(
        '%s %s %s',
        $start,
        $divider,
        $end
    );
}

function generateRandomString($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

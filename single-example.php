<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Http\Controllers\Controller;
use App\PostTypes\Example;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class SingleExampleController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Example();

        the_post();

        $context['page']['content'] = $page->content;

        return new TimberResponse('templates/generic-page.twig', $context);
    }
}

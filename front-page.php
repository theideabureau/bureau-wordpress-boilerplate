<?php

/**
 * The Template for displaying the home page
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class FrontPageController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();

        $page = new Page();

        $context['page']['content'] = $page->content;

        return new TimberResponse('templates/generic-page.twig', $context);
    }
}

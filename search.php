<?php

/**
 * Search results page
 */

namespace App;

use App\Http\Controllers\Controller;
use App\PostTypes\Resource;
use App\PostTypes\Toolkit;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SearchController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $searchQuery = get_search_query();

        // $context['search']['popular_resources'] = collect(get_field('search__popular_resources', 'options'))
        //     ->map(function ($post) {
        //         if ($post->post_type === 'resource') {
        //             $resource = (new Resource($post->ID))->getStageInstance();

        //             return [
        //                 'color' => $resource->colour,
        //                 'title' => $resource->title,
        //                 'icon' => [
        //                     'name' => 'icon-stage-' . $resource->stage()->slug
        //                 ],
        //                 'link' => [
        //                     'url' => $resource->link
        //                 ],
        //             ];
        //         }

        //         if ($post->post_type === 'toolkit') {
        //             $toolkit = new Toolkit($post->ID);

        //             return [
        //                 'color' => 'denim-blue',
        //                 'title' => $toolkit->title,
        //                 'icon' => [
        //                     'name' => 'icon-implementation-toolkit'
        //                 ],
        //                 'link' => [
        //                     'url' => $toolkit->link
        //                 ],
        //             ];

        //             return new Toolkit($post->ID);
        //         }
        //     })
        //     ->toArray();

        if (! $searchQuery) {
            return new TimberResponse('templates/search/initial.twig', $context);
        }

        $resultsQuery = new \WP_Query([
            's' => $searchQuery,
            'posts_per_page' => -1
        ]);

        $context['search']['title'] = 'Search results for \'' . htmlspecialchars($searchQuery) . '\'';
        $context['search']['query'] = $searchQuery;

        $context['search']['results'] = collect($resultsQuery->posts)
            ->map(function ($result) {
                $excerpt = get_the_excerpt($result->ID);

                if ($excerpt) {
                    $excerpt = trim(substr($excerpt, 0, 140)) . '…';
                }

                return [
                    'title' => $result->post_title,
                    'url' => get_permalink($result->ID),
                    'description' => $excerpt
                ];
            })
            ->values();

        return new TimberResponse('templates/search/results.twig', $context);
    }
}

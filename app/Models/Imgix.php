<?php

namespace App\Models;

use Imgix\UrlBuilder;
use Rareloop\Lumberjack\Facades\Config;
use Timber\Timber;

class Imgix
{
    protected object $args;
    protected array $debugColours = [
        'BFDC2626',
        'BFEA580C',
        'BF65A30D',
        'BF0891B2',
        'BF2563EB',
        'BF7C3AED',
        'BFEC4899',
    ];

    public function __construct(array $args)
    {
        $this->args = (object) array_merge([
            'host_transforms' => Config::get('images.imgix_host_transforms'),
            'class' => '',
            'alt' => '',
            'aspect_ratio' => null,
            'loading' => 'lazy'
        ], $args);
    }

    public function render(): string
    {
        return Timber::compile('partials/imgix.twig', [
            'src' => $this->buildURL(0),
            'srcset' => $this->buildSources(),
            'class' => $this->args->class,
            'sizes' => $this->args->sizes,
            'alt' => $this->args->alt,
            'width' => $this->args->aspect_ratio[0] ?? null,
            'height' => $this->args->aspect_ratio[1] ?? null,
            'loading' => $this->args->loading
        ]);
    }

    protected function buildSources(): string
    {
        return collect($this->args->scrset_widths)
            ->map(function ($scrsetWidth, $index) {
                return sprintf(
                    '%s %sw',
                    $this->buildURL($index),
                    $scrsetWidth
                );
            })
            ->join(', ');
    }

    protected function buildURL($widthIndex)
    {
        $width = $this->args->scrset_widths[$widthIndex];

        $transform = array_merge($this->args->params, [
            'w' => $width
        ]);

        // we don't need the host as it's already part of the url
        unset($transform['host']);

        if (isset($this->args->aspect_ratio) && $this->args->aspect_ratio && $transform['w']) {
            $transform['h'] = ceil($transform['w'] / ($this->args->aspect_ratio[0] / $this->args->aspect_ratio[1]));
        }

        $this->args->src = str_replace(
            array_keys($this->args->host_transforms),
            array_values($this->args->host_transforms),
            $this->args->src
        );

        if (Config::get('images.imgix_debug', false)) {
            $transform['mark'] = $this->debugMask($widthIndex);
            $transform['mark-w'] = 0.5;
            $transform['mark-align'] = 'middle,center';
        }

        $url = $this->args->src . '?' . http_build_query($transform);

        return $url;
    }

    protected function debugMask($widthIndex): string
    {
        $builder = new UrlBuilder(Config::get('images.imgix_host'));
        $debugColourIndex = $widthIndex % count($this->debugColours);

        $debugText = sprintf(
            '#%s %spx',
            $widthIndex,
            $this->args->scrset_widths[$widthIndex]
        );

        return $builder->createURL("~text", [
            'bg' => $this->debugColours[$debugColourIndex],
            'txt-align' => 'middle,center',
            'txt-size' => '30',
            'txt-font' => 'PT Sans,Bold',
            'txt' => $debugText,
            'txt-color' => 'FFFFFF',
        ]);
    }
}

<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\FormatExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FormatExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_views', [$this, 'formatViews']),
        ];
    }

    public function formatViews(int $views): string
    {
        if ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'M';
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'K';
        }

        return (string)$views;
    }
}

<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class BootstrapExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('badge', [$this, 'badgeFilter'], ['is_safe' => ['html']]),
            new TwigFilter('badge_bool', [$this, 'booleanBadgeFilter'], ['is_safe' => ['html']]),
        ];

    }

    /**
     * Permet de créer un badge Bootstrap
     *
     * @param string $content
     * @param array $options ['color' => 'primary', 'pill' => false]
     * @return string
     */
    public function badgeFilter($content, $options = [])
    {
        $defaultOptions = [
            "color" => "primary",
            "pill" => false,
        ];

        $options = array_merge($defaultOptions, $options);

        $classes = "badge badge-" . $options['color'] . " " . ($options['pill'] ? 'badge-pill' : '');

        return sprintf(
            '<span class="%s">%s</span>',
            $classes,
            $content
        );
    }

    public function booleanBadgeFilter($content, $options = [])
    {
        $defaultOptions = [
            'true-color' => 'success',
            'true-label' => 'Oui',
            'false-color' => 'danger',
            'false-label' => 'Non',
        ];

        $options = array_merge($defaultOptions, $options);

        $color = $content ? $options['true-color'] : $options['false-color'];

        $label = $content ? $options['true-label'] : $options['false-label'];

        return $this->badgeFilter($label, ['color' => $color]);
    }
}

<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class BootstrapExtension extends AbstractExtension
{
    /**
     * Permet de faire le rendu des tableaux
     *
     * @var BootstrapExtensionTableRenderer
     */
    protected $tableRenderer;

    public function __construct(BootstrapExtensionTableRenderer $tableRenderer)
    {
        $this->tableRenderer = $tableRenderer;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('table', [$this, 'tableFunction'], ['is_safe' => ['html']]),
            new TwigFunction('table_start', [$this, 'tableStartFunction'], ['is_safe' => ['html']]),
            new TwigFunction('table_end', [$this, 'tableEndFunction'], ['is_safe' => ['html']]),
            new TwigFunction('table_header', [$this, 'tableHeaderFunction'], ['is_safe' => ['html']]),
            new TwigFunction('table_body', [$this, 'tableBodyFunction'], ['is_safe' => ['html']]),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('badge', [$this, 'badgeFilter'], ['is_safe' => ['html']]),
            new TwigFilter('badge_bool', [$this, 'booleanBadgeFilter'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Permet de rendre un tableau complet
     *
     * @param array $data
     * @param array $options
     * @return string
     */
    public function tableFunction(array $data, array $options = []): string
    {
        return $this->tableRenderer->renderTable($data, $options);
    }

    /**
     * Permet de rendre une balise <table>
     *
     * @param array $options
     * @return string
     */
    public function tableStartFunction($options = []): string
    {
        return $this->tableRenderer->renderTableStart($options);
    }

    /**
     * Permet de rendre une balise </table>
     *
     * @return string
     */
    public function tableEndFunction(): string
    {
        return $this->tableRenderer->renderTableEnd();
    }

    /**
     * Permet de rendre l'en-tête d'un <table> (<thead>)
     *
     * @param array $headers
     * @return string
     */
    public function tableHeaderFunction($headers = []): string
    {
        return $this->tableRenderer->renderTableHeader($headers);
    }

    /**
     * Permet de rendre le corps du <table> (<tbody>)
     *
     * @param array $data
     * @return string
     */
    public function tableBodyFunction($data = []): string
    {
        return $this->tableRenderer->renderTableBody($data);
    }

    /**
     * Permet de créer un badge Bootstrap
     *
     * @param mixed $content
     * @param array $options ['color' => 'primary', 'pill' => false]
     * @return string
     */
    public function badgeFilter($content, array $options = []): string
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

    /**
     * Permet de rendre un badge "booléen" (Oui / Non)
     *
     * @param bool $content
     * @param array $options
     * @return string
     */
    public function booleanBadgeFilter(bool $content, array $options = []): string
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

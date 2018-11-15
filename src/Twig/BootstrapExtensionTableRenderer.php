<?php

namespace App\Twig;

/**
 * Détails d'implémentation pour le rendu des tableaux bootstrap
 */
class BootstrapExtensionTableRenderer
{
    /**
     * Classes CSS par défaut pour le tableau
     */
    protected $tableClasses = 'table-hover';

    /**
     * Constructeur
     *
     * @param string $tableClasses Les classes par défaut
     */
    public function __construct(string $tableClasses = 'table-hover')
    {
        $this->tableClasses = $tableClasses;
    }

    /**
     * Permet de rendre une balise <table>
     *
     * @param array $options
     * @return string
     */
    public function renderTableStart(array $options = []): string
    {
        return '<table class="table ' . ($options['classes'] ?? $this->tableClasses) . '">';
    }

    /**
     * Permet de rendre une balise </table>
     *
     * @return string
     */
    public function renderTableEnd(): string
    {
        return '</table>';
    }

    /**
     * Permet de rendre un tableau complet !
     *
     * @param array $data
     * @param array $options
     * @return string
     */
    public function renderTable(array $data, array $options = []): string
    {
        $exampleRow = $data[0];
        $headers = array_keys($exampleRow);

        $tableTemplate = '
            <table class="table ' . ($options['classes'] ?? $this->tableClasses) . '">
                <thead>%s</thead>
                <tbody>%s</tbody>
            </table>
        ';

        return sprintf(
            $tableTemplate,
            $this->renderTableHeader($headers),
            $this->renderTableBody($data)
        );
    }

    /**
     * Permet de rendre le corps du tableau (<tbody>)
     *
     * @param array $data
     * @return string
     */
    public function renderTableBody(array $data): string
    {
        $html = '<tbody>';
        foreach ($data as $dataRow) {
            $row = '<tr>';
            foreach ($dataRow as $text) {
                $row .= "<td>$text</td>";
            }
            $row .= '</tr>';
            $html .= $row;
        }

        $html .= '</tbody>';

        return $html;
    }

    /**
     * Permet de rendre une en-tête de table (<thead>)
     *
     * @param array $headers
     * @return string
     */
    public function renderTableHeader(array $headers): string
    {
        $html = '
            <thead>
                <tr>';

        foreach ($headers as $title) {
            $html .= '<th>' . ucfirst($title) . '</th>';
        }

        $html .= '
                </tr>
            </head>
        ';

        return $html;
    }
}

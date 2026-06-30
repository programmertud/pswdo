<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    private function currentYear(): int
    {
        return (int) date('Y');
    }

    public function download(string $dataset, string $format)
    {
        $config = $this->datasetConfig($dataset);

        abort_if(! $config, 404);
        abort_if(! in_array($format, ['pdf', 'excel'], true), 404);

        $year = $this->currentYear();
        $records = DB::table($config['table'])
            ->where('year', $year)
            ->orderBy('lgu_name')
            ->get();

        $rows = $records->values()->map(function ($record, int $index) use ($config) {
            $row = ['No.' => $index + 1];

            foreach ($config['columns'] as $label => $field) {
                $row[$label] = $this->displayValue($record->{$field} ?? null);
            }

            return $row;
        })->all();

        $totals = $this->totalsRow($records, $config);
        $filename = Str::slug($config['title'] . '-' . $year);

        if ($format === 'excel') {
            return response($this->makeExcelHtml($config['title'], $year, $rows, $totals))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
                ->header('Content-Disposition', "attachment; filename=\"{$filename}.xls\"");
        }

        return response($this->makePdf($config['title'], $year, $rows, $totals, $config['widths']))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}.pdf\"");
    }

    private function datasetConfig(string $dataset): ?array
    {
        $sets = [
            'population' => [
                'title' => 'Total Population',
                'table' => 'lgu_populations',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'totals' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'widths' => [5, 36, 16, 16, 16],
            ],
            'development' => [
                'title' => 'Development',
                'table' => 'development_records',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'Male' => 'children_in_school_male',
                    'Female' => 'children_in_school_female',
                    'Total' => 'children_in_school_total',
                    'Remarks' => 'remarks',
                ],
                'totals' => [
                    'Male' => 'children_in_school_male',
                    'Female' => 'children_in_school_female',
                    'Total' => 'children_in_school_total',
                ],
                'widths' => [5, 29, 13, 13, 13, 34],
            ],
            'survival' => [
                'title' => 'Survival',
                'table' => 'survival_records',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'Immunization %' => 'immunization_rate',
                    'Pop. 12 Mos.' => 'total_pop_12_months',
                    '0-59 Mos. Weighed' => 'actual_0_59_months_weighed',
                    'Total Pop. 0-59 Mos.' => 'total_pop_0_59_months',
                    'Pregnant Adolescents' => 'pregnant_adolescents_10_19',
                ],
                'totals' => [
                    'Pop. 12 Mos.' => 'total_pop_12_months',
                    '0-59 Mos. Weighed' => 'actual_0_59_months_weighed',
                    'Total Pop. 0-59 Mos.' => 'total_pop_0_59_months',
                    'Pregnant Adolescents' => 'pregnant_adolescents_10_19',
                ],
                'average' => [
                    'Immunization %' => 'immunization_rate',
                ],
                'widths' => [5, 22, 16, 14, 18, 20, 20],
            ],
            'protection' => [
                'title' => 'Protection',
                'table' => 'protection_records',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'CNSP Cases' => 'cnsp_cases',
                    'CAR/CICL' => 'car_cicl_cases',
                    'Male' => 'car_cicl_male',
                    'Female' => 'car_cicl_female',
                    'Total' => 'car_cicl_total',
                ],
                'totals' => [
                    'CNSP Cases' => 'cnsp_cases',
                    'CAR/CICL' => 'car_cicl_cases',
                    'Male' => 'car_cicl_male',
                    'Female' => 'car_cicl_female',
                    'Total' => 'car_cicl_total',
                ],
                'widths' => [5, 24, 14, 14, 12, 12, 12],
            ],
            'disability' => [
                'title' => 'Children with Disability',
                'table' => 'children_with_disability',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'totals' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'widths' => [5, 36, 16, 16, 16],
            ],
            'ip' => [
                'title' => 'IP Children',
                'table' => 'ip_children',
                'columns' => [
                    'LGU' => 'lgu_name',
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'totals' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'Total' => 'total',
                ],
                'widths' => [5, 36, 16, 16, 16],
            ],
        ];

        return $sets[$dataset] ?? null;
    }

    private function displayValue($value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        if (is_numeric($value)) {
            return number_format((float) $value, floor((float) $value) == (float) $value ? 0 : 2);
        }

        return (string) $value;
    }

    private function totalsRow($records, array $config): array
    {
        $row = ['No.' => '', 'LGU' => 'Total'];

        foreach ($config['columns'] as $label => $field) {
            if ($label === 'LGU') {
                continue;
            }

            $row[$label] = isset($config['average'][$label])
                ? number_format($records->whereNotNull($config['average'][$label])->avg($config['average'][$label]) ?? 0, 2) . '% avg'
                : (isset($config['totals'][$label])
                ? number_format($records->sum($config['totals'][$label]))
                : '');
        }

        return $row;
    }

    private function makeExcelHtml(string $title, int $year, array $rows, array $totals): string
    {
        $headers = array_keys($totals);
        $html = '<html><head><meta charset="UTF-8"></head><body>';
        $html .= '<h2>' . e($title) . '</h2>';
        $html .= '<p>Year: ' . e((string) $year) . '</p>';
        $html .= '<table border="1"><thead><tr>';

        foreach ($headers as $header) {
            $html .= '<th>' . e($header) . '</th>';
        }

        $html .= '</tr></thead><tbody>';

        foreach ($rows as $row) {
            $html .= '<tr>';
            foreach ($headers as $header) {
                $html .= '<td>' . e($row[$header] ?? '') . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '<tr style="font-weight:bold;">';
        foreach ($headers as $header) {
            $html .= '<td>' . e($totals[$header] ?? '') . '</td>';
        }

        return $html . '</tr></tbody></table></body></html>';
    }

    private function makePdf(string $title, int $year, array $rows, array $totals, array $widths): string
    {
        $headers = array_keys($totals);
        $lines = [
            $title,
            'Year: ' . $year,
            '',
            $this->formatPdfRow($headers, $widths),
            str_repeat('-', array_sum($widths) + count($widths) - 1),
        ];

        foreach ($rows as $row) {
            $lines[] = $this->formatPdfRow(array_map(fn ($header) => $row[$header] ?? '', $headers), $widths);
        }

        $lines[] = str_repeat('-', array_sum($widths) + count($widths) - 1);
        $lines[] = $this->formatPdfRow(array_map(fn ($header) => $totals[$header] ?? '', $headers), $widths);

        return $this->buildPdf($lines);
    }

    private function formatPdfRow(array $values, array $widths): string
    {
        $cells = [];

        foreach ($values as $index => $value) {
            $width = $widths[$index] ?? 12;
            $text = $this->ascii((string) $value);
            $text = strlen($text) > $width ? substr($text, 0, max(0, $width - 1)) . '.' : $text;
            $cells[] = str_pad($text, $width);
        }

        return implode(' ', $cells);
    }

    private function buildPdf(array $lines): string
    {
        $pages = array_chunk($lines, 46);
        $objects = [];
        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[3] = '<< /Type /Font /Subtype /Type1 /BaseFont /Courier >>';

        $kids = [];
        $nextObject = 4;

        foreach ($pages as $pageLines) {
            $pageObject = $nextObject++;
            $contentObject = $nextObject++;
            $kids[] = "{$pageObject} 0 R";
            $objects[$pageObject] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 792 612] /Resources << /Font << /F1 3 0 R >> >> /Contents {$contentObject} 0 R >>";
            $stream = $this->pdfContentStream($pageLines);
            $objects[$contentObject] = "<< /Length " . strlen($stream) . " >>\nstream\n{$stream}\nendstream";
        }

        $objects[2] = '<< /Type /Pages /Kids [' . implode(' ', $kids) . '] /Count ' . count($kids) . ' >>';
        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $number => $object) {
            $offsets[$number] = strlen($pdf);
            $pdf .= "{$number} 0 obj\n{$object}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }

    private function pdfContentStream(array $lines): string
    {
        $stream = "BT\n/F1 8 Tf\n11 TL\n32 570 Td\n";

        foreach ($lines as $line) {
            $stream .= '(' . $this->pdfEscape($line) . ") Tj\nT*\n";
        }

        return $stream . "ET";
    }

    private function pdfEscape(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $this->ascii($text));
    }

    private function ascii(string $text): string
    {
        $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);

        return $converted !== false ? $converted : preg_replace('/[^\x20-\x7E]/', '', $text);
    }
}

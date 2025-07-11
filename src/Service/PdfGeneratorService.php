<?php
namespace App\Service;

use Knp\Snappy\Pdf;

class PdfGeneratorService
{
    public function __construct(private readonly Pdf $snappyPdf) {}

    public function generate(string $html, string $outputPath): void
    {
        $this->snappyPdf->generateFromHtml($html, $outputPath);
    }
}

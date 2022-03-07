<?php

namespace App\src\Invoices\pdf;

use TCPDF;

define('K_PATH_IMAGES', realpath('./images')); // path with images overwritten

class InvoicePdf extends TCPDF implements Invoice
{
    private string $headerTitle = '<<set_header_title>>';
    private string $headerImageName = 'LogoMain.png';
    private string $headerFontFamily = 'helvetica';
    private int $headerFontSize = 20;
    private string $headerFontStyle = 'B';

    private string $footerFontFamily = 'helvetica';
    private int $footerFontSize = 8;
    private string $footerFontStyle = 'I';
    private string $footerPageText = 'Page';

    public function setHeaderTitle(string $headerTitle): void
    {
        $this->headerTitle = $headerTitle;
    }

    public function setHeaderImageName(string $headerImageName): void
    {
        $this->headerImageName = $headerImageName;
    }

    public function setHeaderFontFamily(string $headerFontFamily): void
    {
        $this->headerFontFamily = $headerFontFamily;
    }

    public function setHeaderFontSize(int $headerFontSize): void
    {
        $this->headerFontSize = $headerFontSize;
    }

    public function setHeaderFontStyle(string $headerFontStyle): void
    {
        $this->headerFontStyle = $headerFontStyle;
    }

    public function setFooterFontFamily(string $footerFontFamily): void
    {
        $this->footerFontFamily = $footerFontFamily;
    }

    public function setFooterFontSize(int $footerFontSize): void
    {
        $this->footerFontSize = $footerFontSize;
    }

    public function setFooterFontStyle(string $footerFontStyle): void
    {
        $this->footerFontStyle = $footerFontStyle;
    }

    public function setFooterPageText(string $footerPageText): void
    {
        $this->footerPageText = $footerPageText;
    }


    public function Header() {

        $imageType = strtoupper(explode('.', $this->headerImageName)[1]);

        $imageFile = K_PATH_IMAGES . '/' . $this->headerImageName;
        $this->Image($imageFile, 10, 10, 15, '', $imageType, '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont($this->headerFontFamily, $this->headerFontStyle, $this->headerFontSize);
        // header title
        $this->Cell(0, 15, $this->headerTitle, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont($this->footerFontFamily, $this->footerFontStyle, $this->footerFontSize);
        // Page number
        $this->Cell(0, 10, $this->footerPageText . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function printToFile(string $fileName): void
    {
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        //$this->pdf->Output('example_001.pdf', 'I');
        $this->Output($fileName, 'I');
    }
}

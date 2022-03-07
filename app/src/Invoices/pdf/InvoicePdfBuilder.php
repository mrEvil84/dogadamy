<?php

namespace App\src\Invoices\pdf;

class InvoicePdfBuilder implements InvoicePageBuilder
{
    private InvoicePdf $pdf;


    public function __construct()
    {
        $this->instantiate();
    }

    public function instantiate(): void
    {
        $this->pdf = new InvoicePdf(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            'UTF-8',
            false,
            false
        );
    }

    public function setHeaderTitle(string $headerTile = 'Invoice'): void
    {
        $this->pdf->setHeaderTitle($headerTile);
    }

    public function build(): Invoice
    {
        $this->setHeaderTitle();
        $this->setDocInformation();
        $this->setHeaderData();
        $this->setFooterData();

        $this->getSetHeaderFont();
        $this->getSetFooterFont();

        $this->setDefaultMonospacedFont();
        $this->setMargins();

        $this->setAutoPageBreaks();
        $this->setImageScaleFactor();

        $this->setDefaultFontSubsettingMode();
        $this->setFont();

        $this->addPage();

        $this->setTextShadowEffectMoved();

        $html = $this->setHtmlContentToPrint();
        $this->setHtmlContent($html);

        return $this->pdf;
    }

    public function setDocInformation(): void
    {
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Pikej');
        $this->pdf->SetTitle('Invoice');
        $this->pdf->SetSubject('Feb 2022');
        $this->pdf->SetKeywords('invoice, PDF, februar, 2022, pww');
    }

    public function setHeaderData(): void
    {
// set header data
        $this->pdf->SetHeaderData(
            PDF_HEADER_LOGO,
            PDF_HEADER_LOGO_WIDTH,
            'Pww24 Invoice Feb2022',
            'Invoice Feb202',
            array(0, 64, 255),
            array(0, 64, 128)
        );
    }

    public function setFooterData(): void
    {
        $this->pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
    }

    public function getSetFooterFont(): void
    {
        $this->pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    }

    public function getSetHeaderFont(): void
    {
        $this->pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    }

    public function setDefaultMonospacedFont(): void
    {
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    }

    public function setMargins(): void
    {
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    }

    public function setAutoPageBreaks(): void
    {
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    }

    public function setImageScaleFactor(): void
    {
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    }

    public function setDefaultFontSubsettingMode(): void
    {
        $this->pdf->setFontSubsetting(true);
    }

    public function setFont(): void
    {
// Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $this->pdf->SetFont('dejavusans', '', 14, '', true);
    }

    public function setTextShadowEffectMoved(): void
    {
        $this->pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
    }


    public function addPage(): void
    {
        // This method has several options, check the source code documentation for more information.
        $this->pdf->AddPage();
    }

    public function setHtmlContentToPrint(): string
    {
        $html = '
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
<p><img src="./images/LogoMain.png" alt="test alt attribute" width="60" height="30" /></p>';
        return $html;
    }
    public function setHtmlContent(string $html): void
    {
        $this->pdf->writeHTML($html, true, false, true, false, '');
//        $this->pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }
}

<?php

namespace App\src\Invoices\pdf;



class InvoicesPrinter
{
//    public function print(Invoice $invoice, string $fileName): void
//    {
//        $pdf = new InvoicePdf(
//            PDF_PAGE_ORIENTATION,
//            PDF_UNIT,
//            PDF_PAGE_FORMAT,
//            true,
//            'UTF-8',
//            false,
//            false
//        );
//        $pdf->setHeaderTitle('Invoice , feb 2022');
//
//        // set doc information
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Pikej');
//        $pdf->SetTitle('Invoice');
//        $pdf->SetSubject('Feb 2022');
//        $pdf->SetKeywords('invoice, PDF, februar, 2022, pww');
//
//        // set header data
//        $pdf->SetHeaderData(
//            PDF_HEADER_LOGO,
//            PDF_HEADER_LOGO_WIDTH,
//            'Pww24 Invoice Feb2022',
//            'Invoice Feb202',
//            array(0,64,255),
//            array(0,64,128)
//        );
//
//
//        // set footer data
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
//
//        // set header font
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//        // set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//        // set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
////        // set some language-dependent strings (optional)
////        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
////            require_once(dirname(__FILE__).'/lang/eng.php');
////            $pdf->setLanguageArray($l);
////        }
//        // set default font subsetting mode
//        $pdf->setFontSubsetting(true);
//
//        // Set font - moved
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // helvetica or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 14, '', true);
//
//        // Add a page - moved
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        // set text shadow effect - moved
//        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//
//        // Set some content to print
//        $html = <<<EOD
//<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
//<i>This is the first example of TCPDF library.</i>
//<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
//<p>Please check the source code documentation and other examples for further information.</p>
//<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
//EOD;
//        // Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('example_001.pdf', 'I');
//    }

//    public function print(Invoice $invoice, string $fileName): void
//    {
//        $invoice->printToFile($fileName);
//    }
}

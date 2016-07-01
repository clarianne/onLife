<?php

/**
 * Creates a PDF of Inventory Report using TCPDF
 * @package com.tecnick.tcpdf
 */

// Include the main TCPDF library (search for installation path).
require_once('includes/tcpdf_min/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
    
    // Colored table
    public function ColoredTable($header,$data) {
        
        // Colors, line width and bold font
        $this->SetFillColor(0, 0, 255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
       
        // Header
        $w = array(30, 45, 35, 30, 35);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Data
        $fill = 0;
        $count = 0;
        $actual = 0;
            foreach($data as $row) {
                $fill = 0;
                foreach($data as $row) {
                    $this->Cell($w[0], 6, $row['product_code'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[1], 6, $row['prod_name'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 6, number_format($row['dist_price']), 'LR', 0, 'R', $fill);
                    $this->Cell($w[3], 6, number_format($row['quantity']), 'LR', 0, 'R', $fill);
                    $this->Cell($w[4], 6, number_format($row['item_price']), 'LR', 0, 'R', $fill);
                    $this->Ln();
                    $fill=!$fill;
                }
            }
            $this->Cell($w[3], 6, "Total", 'LR', 0, 'C', $fill, null, 3);
            $this->Cell($w[4], 6, number_format($row['order_total']), 'LR', 0, 'C', $fill, null, 3);
            //$this->Cell($w[2], 6, number_format($actual), 'LR', 0, 'C', $fill, null, 3);
            $this->Ln();
            $fill=!$fill;

        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function Footer(){

        //System Time
        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/Y h:i:s a', time());

        //Set Y and Font
        $this->SetY(-15);
        $this->SetFont('courier', 'I', 8);
       
        // Title
        $this->Cell(50, 15, 'Order Form Generated From:', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(50, 15, 'onLife.co', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(50, 15, $date, 0, false, 'R', 0, '', 0, false, 'M', 'M');
    }
}
// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('onLife Order Form');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO_WIDTH, PDF_HEADER_LOGO_WIDTH, 'Order Form for: ', $order_list['lfsi_id']);
$pdf->SetFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);



// add a page
$pdf->AddPage();

$html = '<h3>Orders</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');
// column titles
$header = array('Product Code','Product Name', 'Distributor\'s Price', 'Quantity', 'Subtotal');

// data loading
// print colored table
//$pdf->ColoredTable($header, $order_list['books']);
$pdf->ColoredTable($header, $order_list);

$html = '<br/><br/><br/><br/>Certified true and accurate by: <b><u>'. $order_list['fname'] . ' ' . $order_list['lname'] .'</u></b><br/>Signature:';
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('order_form.pdf', 'I');
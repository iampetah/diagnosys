<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';


// Create a PDF object
$pdf = new FPDF('P', 'mm', 'Letter');


$requestModel = new RequestModel();
$requests = $requestModel->getRequestsByStatus(Request::PAID);
$pdf->AddPage();
//page width = 200
// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title


// Invoice details
$pdf->Image('../../assets/img/logo01.png', 1, 10, 28, 28, 'PNG');
$pdf->Image('../../assets/img/logo02.png', 180, 10, 33, 33, 'PNG');

$pdf->SetFont('Arial', 'B', 25);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 10, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 10, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 10, 'Statement of Account', 0, 1, 'C', $pdf->SetTextColor(0, 0, 0));

$pdf->Ln(5);

// Table header


$services = '';
//foreach ($request->services as $service) {
//  $services .= $service->name . ', ';
//  $pdf->Cell(128, 10, $service->name, 1);
//  $pdf->Cell(70, 10, $service->price, 1);
//  $pdf->Ln(10);
//}


$pdf->Ln(10);
$pdf->Cell(20, 10, "ID", 1, 0, 'C');
$pdf->Cell(50, 10, "Last Name", 1, 0, "C");
$pdf->Cell(50, 10, "First Name", 1, 0, "C");
$pdf->Cell(50, 10, "Total Amount", 1, 0, "C");
$pdf->Cell(30, 10, "Status", 1, 0, "C");
$pdf->Ln(10);
$pdf->SetFont("Arial", '', 10);

foreach ($requests as $request) {
  $pdf->Cell(20, 10, $request->id, 1, 0, 'C');
  $pdf->Cell(50, 10, strtoupper($request->patient->last_name), 1, 0, "C");
  $pdf->Cell(50, 10, strtoupper($request->patient->first_name), 1, 0, "C");
  $pdf->Cell(50, 10, $request->total, 1, 0, "C");
  $pdf->Cell(30, 10, strtoupper($request->status), 1, 0, "C");
  $pdf->Ln(10);
}




// Total

$pdf->Ln(20);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(120, 3, 'Evelyn A. Nuyad', 0);

$pdf->Cell(200, 3, 'Elpidio Carcallas-Nuyad, RMT', 0, 1);
$pdf->Cell(120, -2, '___________________', 0);

$pdf->Cell(55, -2, '__________________________', 0, 1);
$pdf->SetFont('Arial', '', 8);

$pdf->Cell(130, 10, 'P.R.C Number:0066658', 0);

$pdf->Cell(150, 10, 'P.R.C Number:0030677', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(135, 206, 235);

$pdf->Cell(139, -2, 'PCDC OWNER', 0, 0);

$pdf->Cell(150, -2, 'Cashier', 0, 0);
// Output the PDF
$pdf->Output('invoice.pdf', 'I');

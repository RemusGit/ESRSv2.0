<?php
/////////////////////////////////////////////////////// FOR FPDF AUTO PAGINATION
require_once(public_path('fpdf_v1.86/fpdf.php'));

class MyPDF extends \FPDF
{
    function Footer()
    {
        // Push footer 15mm from bottom
        $this->SetY(-15);

        $this->SetFont('Arial', 'I', 8);

        // Page X / Y
        $this->Cell(0, 10, 'Page '.$this->PageNo().' of {nb}', 0, 0, 'R');
    }
}

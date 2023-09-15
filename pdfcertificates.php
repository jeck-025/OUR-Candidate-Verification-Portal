<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once ('pdfprototype/fpdi/src/autoload.php');
require_once ('pdfprototype/fpdf.php');
require_once ('resource/php/class/config.php');


$config = new config();
$con = $config->con();
$sql = "SELECT * FROM `tbl_client_user` WHERE `tn`='$_GET[tn]'";
$data1 = $con->prepare($sql);
$data1->execute();
$data = $data1->fetchAll(PDO::FETCH_ASSOC);
$data = $data[0];



if($data['campus'] === "MLS") {
    $file = "CAVE_ECertificate_MLS.pdf";
}else if($data['campus'] === "MKT") {
    $file = "CAVE_ECertificate_MKT.pdf";
}else{
    $file = "CAVE_ECertificate_MNL.pdf";
}


    $pdf = new FPDI();
    $pdf->AddPage("L");
    $pdf->setSourceFile($file);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica');

    $pdf->SetFontSize(25);
    $pdf->SetXY(88, 76);
    $pdf->Write(0, utf8_decode($data['vfname']));

    $pdf->SetFontSize(11);
    $pdf->SetXY(129, 103);
    $pdf->Write(0, DATE("d"));
    $pdf->SetXY(152, 103);
    $pdf->Write(0, DATE("F"));
    $pdf->SetXY(179, 103);
    $pdf->Write(0, DATE("Y"));
    

    $yg = "N/A";
    $vyg = "N/A";
    $yla= "N/A";
    $vfla = "N/A";


    if($data['yearsGrad']!="" || $data['yearsGrad']!=NULL){
        $yg = $data['yearsGrad'];
    }
    if($data['vfDateGrad']!=""||$data['vfDateGrad']!=NULL){
        $vyg = $data['vfDateGrad'];
    }
    if($data['yearsLastAtt']!=""||$data['yearsLastAtt']!=NULL){
        $yla = $data['yearsLastAtt'];
    }
    if($data['vfDateEnt']!=""||$data['vfDateEnt']!=NULL){
        $vfla = $data['vfDateEnt'];
    }

    $pdf->SetFontSize(17);
    $pdf->SetXY(202, 128);
    $pdf->Write(0, $yg);
    $pdf->SetXY(202, 154);
    $pdf->Write(0, $vyg);

    $pdf->SetFontSize(17);
    $pdf->SetXY(160, 128);
    $pdf->Write(0, $yla);
    $pdf->SetXY(160, 154);
    $pdf->Write(0, $vfla);

    if (strlen($data['degree']) <= 60){
        $pdf->SetFontSize(12);
        $pdf->SetXY(85, 126);
        $pdf->MultiCell(70,5, $data['degree'],"l");
        $pdf->SetXY(85, 149);
        $pdf->MultiCell(70,5, $data['vfdegree'],"l");
    }
    else {
        $pdf->SetFontSize(8);
        $pdf->SetXY(94, 123);
        $pdf->MultiCell(70,3, $data['degree'],"l");

        $pdf->SetXY(94, 148);
        $pdf->MultiCell(70,3, $data['vfdegree'],"l");
    }

    if($data['campus'] === "Malolos" || $data['campus'] === "Makati"){
        $pdf->SetFontSize(14);
        $pdf->SetXY(245, 129);
        $pdf->Write(0, $data['campus']);
        $pdf->SetXY(245, 155);
        $pdf->Write(0, $data['vfcampus']);
    }
    else {
        $pdf->SetFontSize(14);
        $pdf->SetXY(245, 129);
        $pdf->Write(0, $data['campus']);
        $pdf->SetXY(245, 155);
        $pdf->Write(0, $data['vfcampus']);
    }

    $pdf->SetFontSize(8);
    $pdf->SetXY(35, 131);
    $fullname = $data['firstName']." ".$data['middleName']." ".$data['lastName'];
    $fullname = utf8_decode($fullname);
    $pdf->Write(0, $fullname);
    $pdf->SetXY(35, 153);
    $pdf->Write(0, utf8_decode($data['vfname']));

    $tn = "Certificate S/N: ".$data['tn'];
    $pdf->SetXY(227, 6);
    $pdf->Write(0, $tn);

    $pdf->SetXY(232, 9);
    $pdf->Write(0, "Scan QR Below and enter the S/N");

    $pdf->Image('resource/img/caveqr.png', "257","12", "18","18");

    $pdf->output("I", "CAVE_VerifiedECert_$data[lastName].pdf");
?>

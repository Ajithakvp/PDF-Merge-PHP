<?php  @session_start();
error_reporting(E_ALL);
date_default_timezone_set("Asia/Calcutta");
require_once 'config.php';
require_once 'qr/qr.php';
require_once 'mpdfin/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
include_once 'functions.php';


//$mpdf = new \Mpdf\Mpdf();
$mpdf->SetDisplayMode('fullpage');
//$mpdf->debug = true;
$mpdf->showImageErrors = true;

$header='
<table width="100%"><tr>
<td><img src="images/logo.png" width="125"></td>
</tr></table>';


	$mpdf->SetWatermarkText('PREVIEW');
	$mpdf->watermark_font = 'DejaVuSansCondensed';
	$mpdf->showWatermarkText = true;


$footer = '<table width="100%"><tr><td><img src="images/footer.png"></td></tr></table>';
$mpdf->SetXY(15,12);

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);

///////////////////////merge begins
$termsPDF="{$dirs}beta1/new_terms.pdf";
$addPdfFiles = array($termsPDF,"1.pdf","2.pdf");
$filesTotal = sizeof($addPdfFiles);
$fileNumber = 1;
foreach ($addPdfFiles as $fileName) {
	if (file_exists($fileName)){
		$pagesInFile = $mpdf->SetSourceFile($fileName);
		for ($i = 1; $i <= $pagesInFile; $i++) {
			$mpdf->WriteHTML('<pagebreak />');
			$mpdf->SetHTMLHeader(""); 
			$mpdf->SetHTMLFooter(""); 
			$tplId = $mpdf->importPage($i);
			$mpdf->UseTemplate($tplId);
		}
	}
	$fileNumber++;
}

/////////////////////////merge ends

////////////////////////////o/p begins
$filename = "MPDF.pdf";
$mpdf->Output($filename,'F');
//////////////////////////////o/p ends
	?>
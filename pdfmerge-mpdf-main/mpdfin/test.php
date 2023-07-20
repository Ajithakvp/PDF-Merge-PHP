<?php 

// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Database Connection 
/*$conn = new mysqli('localhost', 'root', '', 'csm4');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
// Select data from MySQL database
$select = "SELECT * FROM `empdata`";
$result = $conn->query($select);
$data = array();
while($row = $result->fetch_object()){
	$data .= '<tr>'
		  .'<td>'.$row->name.'</td>'
		  .'<td>'.$row->address.'</td>'
		  .'<td>'.$row->phone.'</td></tr>';
}

// Take PDF contents in a variable
$pdfcontent = '<h1>Welcome to etutorialspoint.com</h1>
		<h2>Employee Details</h2>
		<table autosize="1">
		<tr>
		<td style="width: 33%"><strong>NAME</strong></td>
		<td style="width: 36%"><strong>ADDRESS</strong></td>
		<td style="width: 30%"><strong>PHONE</strong></td>
		</tr>
		'.$data.'
		</table>';*/
$pdfcontent="test";
$mpdf->WriteHTML($pdfcontent);

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('etutorialspoint');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();		
?>
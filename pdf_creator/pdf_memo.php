<?php
require_once'../modelo/conexion.php';
require_once'../modelo/memo.php';
//require_once('../mpdf-6.0.0/mpdf.php');
	$id = (int)$_GET['id'];
	$nuevo = new Memo();
	$result = $nuevo->colsultarMemo($conexion, $id);
if (!$result){
	echo "ocurrio un error.\n";
exit;}
	$row[] = pg_fetch_assoc($result);
$html= '
	<style>
	h1{font-size: 30px; color:#444; margin-top: 50px; text-align: center;}
	label {font-weight: bold; color: #444; font-size: 16px; width: 15%; text-align: justify;}
	input {font-size: 14px; padding: 1px 20px; width: 70%; margin-bottom: 10px; margin-left: 20px; border:none; text-align: justify;}
	.hh {width: 85%; text-aling: justify;}
	</style>
	<header class="header">
	<div id="logo">
		<img src="../Imagenes/encabezado_pnf.png">
	</div>
	<h1>MEMO</h1><hr>
	</header>
	<main>
	<table align="center">';
foreach ($row as $rows) {
$html .='<tr>
		<td><label>Fecha</label></td>
		<td class="hh">'.$rows['date'].'</td>
	</tr>
	<tr>
		<td><label>De</label></td>
		<td class="hh">'.$rows['de'].'</td>
	</tr>
	<tr>
		<td><label>Para</label></td>
		<td class="hh">'.$rows['para'].'</td>
	</tr>
	<tr>
		<td><label>Señor(A)</label></td>
		<td class="hh">'.$rows['motivo'].'</td>
	</tr>
	<tr>
		<td><label>Notas</label></td>
		<td class="hh">'.$rows['notas'].'</td>
	</tr>';
	}
$html .='</table>
	<br>
	<br>
	<br>
	<br>
	<label class="ll">Emitido por:</label>
	<br>
	<label class="ll">Cargo:</label>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<label class="ww">Firma:</label>
	</main>';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
include '../mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'c']);
$mpdf->WriteHTML($html);
$mpdf->Output();

//$mpdf = new mPDF('c', 'A4');
//$mpdf->writeHTML($html);
//$mpdf->Output('reporte.pdf', 'I');
?>
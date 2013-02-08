<?php

/**
 * Extrai paginas de um pdf
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Rafael Macário Bolina
 * @since 2013-02-07
 */

date_default_timezone_set('America/Sao_Paulo');

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
require_once('../fpdi/src/fpdi.php');

$arquivoPDF = 'seu_arquivo_aqui.pdf';
$paginas = array(1,2,3,4,5,6,7,8,9,10); //páginas selecionadas para formarem um novo pdf
try {
  createNewPDF($paginas,$arquivoPDF);
} catch (Exception $e) {
	print "Erro: ".$e;
}

function createNewPDF($paginas,$arquivoPDF){
	$pdf = new FPDI();
	$pagecount = $pdf->setSourceFile($arquivoPDF);
	//percorre as paginas adicionando as selecionadas para comporem um novo pdf
	for($i=1;$i<=$pagecount;$i++){
		if(in_array($i, $paginas)){
			$tplidx = $pdf->importPage($i, '/MediaBox');
			$pdf->addPage();
			$pdf->useTemplate($tplidx, 10, 10, 90);
		}
	}
	$pdf->Output('newpdf-xxxxx.pdf', 'D');
}

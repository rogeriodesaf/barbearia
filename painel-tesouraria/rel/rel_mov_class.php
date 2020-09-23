<?php 

include('../../conexao.php');

date_default_timezone_set('America/Sao_Paulo');

//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dataInicial = $_POST['dataInicialPost'];
$dataFinal = $_POST['dataFinalPost'];
$tipo = $_POST['tipo'];



if ($dataInicial == ''){
	$dataInicial = Date('Y-m-d');
}

if ($dataFinal == ''){
	$dataFinal = Date('Y-m-d');
}

if ($tipo == ''){
	$tipo = 'Todas';
}

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = utf8_encode(file_get_contents($url_sistema."/painel-tesouraria/rel/rel_mov.php?dataInicial=".$dataInicial."&dataFinal=".$dataFinal."&tipo=".$tipo));



//INICIALIZAR A CLASSE DO DOMPDF
$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(utf8_decode($html));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'relatorioMov.pdf',
array("Attachment" => false)
);



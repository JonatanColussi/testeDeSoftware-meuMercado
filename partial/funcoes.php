<?php
function dataBanco($data){
	$dt = explode('/', $data);
	$retorno = $dt[2].'-'.$dt[1].'-'.$dt[0];
	return $retorno;
}
function dataExibicao($data){
	$dt = explode('-', $data);
	$retorno = $dt[2].'/'.$dt[1].'/'.$dt[0];
	return $retorno;
}
function formataHora($hora){
	$horaCerta = substr($hora, 0, 5);
	$horaCerta = str_replace(':', 'h', $horaCerta);
	$horaCerta .= 'min';
	return $horaCerta;
}
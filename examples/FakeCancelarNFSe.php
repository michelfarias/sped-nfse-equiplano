<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\NFSeEquiplano\Tools;
use NFePHP\NFSeEquiplano\Common\Soap\SoapFake;
use NFePHP\NFSeEquiplano\Common\FakePretty;

try {
    
    $config = [
        'cnpj' => '99999999000191',
        'im' => '1733160024',
        'optsimples' => 1,
        'cmun' => '4108403', //ira determinar as urls e outros dados
        'razao' => 'Empresa Test Ltda',
        'optante_simples' => true,
        'tpamb' => 2 //1-producao, 2-homologacao
    ];
    
    $configJson = json_encode($config);
    $content = file_get_contents('expired_certificate.pfx');
    $password = 'associacao';
    $cert = Certificate::readPfx($content, $password);
    
    $soap = new SoapFake();
    $soap->disableCertValidation(true);
    
    $tools = new Tools($configJson, $cert);
    $tools->loadSoapClass($soap);
    $numero = '201800000000001';
    $motivo = 'Teste de cancelamento';
    
    $response = $tools->cancelarNfse($numero, $motivo);
    echo FakePretty::prettyPrint($response, '');
 
} catch (\Exception $e) {
    echo $e->getMessage();
}
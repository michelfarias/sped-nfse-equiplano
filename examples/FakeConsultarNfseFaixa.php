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

    
    $dtini = '2020-01-01'; //OBRIGATORIO
    $dtfim = '2020-01-31'; //OBRIGATORIO
    $tomador = (object) [
       'numero' => '12345678901', //OBRIGATORIO numero do documento (20) SE tomador indicado
       'tipo' => 2, //OBRIGATORIO tipo 1-cnpj 2-cpf 3-idestrangeiro  SE tomador indicado
       'documento' => 'passaporte', //Opcional Nome do documento utilizado pelo estrnageiro (30)  SE tomador estrangeiro
        //'nome' => 'Fulano de Tal' //Opcional nome do tomador (80)
    ];


    $response = $tools->consultarNfse($dtini, $dtfim, $tomador);
    
    echo FakePretty::prettyPrint($response, '');
 
} catch (\Exception $e) {
    echo $e->getMessage();
}

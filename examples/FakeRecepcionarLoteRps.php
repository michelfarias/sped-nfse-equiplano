<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\NFSeEquiplano\Tools;
use NFePHP\NFSeEquiplano\Rps;
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

    $arps = [];

    $std = new \stdClass();
    $std->nrRps = 1;
    $std->nrEmissorRps = 1;
    $std->dtEmissaoRps = '2019-08-08T14:58:14';
    $std->stRps = 1; //1=converter, 2=converter e cancelar NFS, 3=cancelar RPS
    $std->tpTributacao = 1; //1=tributado no munícipio, 2=em outro munícipio, 3=isento/imune, 4=suspenso/decisão judicial
    $std->isIssRetido = 2; //1=sim, 2=não
    $std->vltotalrps = 100.00;
    $std->vlliquidorps = 100.00;

    /*
    $std->tomador = new \stdClass();
    $std->tomador->nrdocumento = '12345678901234';
    $std->tomador->tpdocumento = 2; //1=cpf, 2=cnpj, 3=estrangeiro
    $std->tomador->dsDocumentoEstrangeiro = null; //obrigatório se tpDocumento=3 max 30 caracteres
    $std->tomador->nmtomador = 'Fulano da Tal';
    $std->tomador->dsemail = null;
    $std->tomador->nrinscricaoestadual = null;
    $std->tomador->nrinscricaomunicipal = null;
    $std->tomador->dsendereco = null;
    $std->tomador->nrendereco = null;
    $std->tomador->dscomplemento = null;
    $std->tomador->nmbairro = null;
    $std->tomador->nrcidadeibge = null;
    $std->tomador->nmuf = null;
    $std->tomador->nmcidadeestrangeira = null;
    $std->tomador->nmpais = 'BRASIL';
    $std->tomador->nrcep = null;
    $std->tomador->nrtelefone = null;
*/
    $std->servico = new \stdClass();
    $std->servico->nrservicoitem = 4;
    $std->servico->nrservicosubItem = 7;
    $std->servico->vlservico = 100.00;
    $std->servico->vlaliquota = 0.5;
    $std->servico->vlBaseCalculo = 100.00;
    $std->servico->vlissservico = 5.00;
    $std->servico->discriminacao = 'Teste de Emissao';

//$std->servico->deducao = new \stdClass();
//$std->servico->deducao->vldeducao = 12;
//$std->servico->deducao->dsjustificativadeducao = 'Sem justificativa';

    /*
    $std->retencoes = new \stdClass();
    $std->retencoes->vlcofins = 0;
    $std->retencoes->vlcsll = 0;
    $std->retencoes->vlinss = 0;
    $std->retencoes->vlirrf = 0;
    $std->retencoes->vlpis = 0;
    $std->retencoes->vliss = 0;
    $std->retencoes->vlaliquotacofins = 0;
    $std->retencoes->vlaliquotacsll = 0;
    $std->retencoes->vlaliquotainss = 0;
    $std->retencoes->vlaliquotairrf = 0;
    $std->retencoes->vlaliquotapis = 0;
    */

    $arps[] = new Rps($std);
    $lote = '123456';
    $optsimples = 1;
    
    $response = $tools->recepcionarLoteRps($arps, $lote, $optsimples);  //METODO ASSINCRONO

    echo FakePretty::prettyPrint($response, '');
} catch (\Exception $e) {
    echo $e->getMessage();
}
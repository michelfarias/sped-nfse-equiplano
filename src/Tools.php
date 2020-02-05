<?php

namespace NFePHP\NFSeEquiplano;

/**
 * Class for comunications with NFSe webserver in Nacional Standard
 *
 * @category  Library
 * @package   NFePHP\NFSeEquiplano
 * @copyright NFePHP Copyright (c) 2020
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse-equiplano for the canonical source repository
 */

use NFePHP\Common\Certificate;
use NFePHP\Common\Validator;
use NFePHP\NFSeEquiplano\Common\Tools as BaseTools;
use NFePHP\NFSeEquiplano\RpsInterface;
use NFePHP\Common\Signer;
use \stdClass;

class Tools extends BaseTools
{
    
    /**
     * Construtor
     * @param string $config
     * @param Certificate $cert
     */
    public function __construct($config, Certificate $cert)
    {
        parent::__construct($config, $cert);
    }
    
    /**
     * Cancela NFSe emitida e autorizada
     * @param integer $numero
     * @param integer $motivo
     * @return string
     */
    public function cancelarNfse($numero, $motivo)
    {
        $operation = 'esCancelarNfse';
        $xsd = "{$operation}Envio_v01.xsd";
        
        $content = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . $this->prestador
            . "<nrNfse>{$numero}</nrNfse>"
            . "<dsMotivoCancelamento>Cancelamento</dsMotivoCancelamento>"
            . "</es:{$operation}Envio>";
        $content = $this->sign($content, "{$operation}Envio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
    
    /**
     * Consulta situacao do lote RPS com o protocolo ou com o numero do lote
     * @param string $protocolo
     * @param string $lote
     * @return string
     */
    public function consultarSituacaoLoteRps($protocolo = null, $lote = null)
    {
        $operation = 'esConsultarSituacaoLoteRps';
        $xsd = "{$operation}Envio_v01.xsd";
        
        $content = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . $this->prestador;
        if (!empty($protocolo)) {
            $content .= "<nrProtocolo>{$protocolo}</nrProtocolo>";
        } else {
            $content .= "<nrLoteRps>{$lote}</nrLoteRps>";
        }
        $content .= "</es:{$operation}Envio>";
        $content = $this->sign($content, "{$operation}Envio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
    
    /**
     * Consulta o lote RPS com o protocolo ou com o numero do lote
     * @param string $protocolo
     * @param string $lote
     * @return string
     */
    public function consultarLoteRps($protocolo = null, $lote = null)
    {
        $operation = 'esConsultarLoteRps';
        $xsd = "{$operation}Envio_v01.xsd";
        
        $content = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . $this->prestador;
        if (!empty($protocolo)) {
            $content .= "<nrProtocolo>{$protocolo}</nrProtocolo>";
        } else {
            $content .= "<nrLoteRps>{$lote}</nrLoteRps>";
        }
        $content .= "</es:{$operation}Envio>";
        $content = $this->sign($content, "{$operation}Envio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
    
    /**
     * Consulta NFSe emitidas em um periodo (SINCRONO)
     * @param string dtini
     * @param string dtfim
     * @param \stdClass $tomador
     * @return string
     */
    public function consultarNfse($dtini, $dtfim, stdClass $tomador = null)
    {
        $operation = 'esConsultarNfse';
        $xsd = "{$operation}Envio_v01.xsd";
        $tom = '';
        if (!empty($tomador)) {
            $tom = "<tomador>"
                . "<documento>"
                . "<nrDocumento>{$tomador->numero}</nrDocumento>"
                . "<tpDocumento>{$tomador->tipo}</tpDocumento>";
            $tom .= !empty($tomador->documento) &&  $tomador->tipo == 3
                ? "<dsDocumentoEstrangeiro>{$tomador->documento}</dsDocumentoEstrangeiro>"
                : '';
            $tom .= "</documento>";
            $tom .= !empty($tomador->nome)
                ? "<nmTomador>{$tomador->nome}</nmTomador>"
                : '';
            $tom .= "</tomador>";
        }
        $content = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . $this->prestador
            . "<periodoEmissao>"
            . "<dtInicial>{$dtini}T00:00:00</dtInicial>"
            . "<dtFinal>{$dtfim}T23:59:59</dtFinal>"
            . $tom
            . "</periodoEmissao>"
            . "</es:{$operation}Envio>";
        $content = $this->sign($content, "{$operation}Envio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
    
    /**
     * Consulta NFSe emitidas por RPS
     * @param integer $numero
     * @param integer $nremissor
     * @return string
     */
    public function consultarNfsePorRps($numero, $nremissor)
    {
        $operation = 'esConsultarNfsePorRps';
        $xsd = "{$operation}Envio_v01.xsd";
        
        $content = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . "<rps>"
        . "<nrRps>$numero</nrRps>"
        . "<nrEmissorRps>$nremissor</nrEmissorRps>"
        . "</rps>"
            . $this->prestador
            . "</es:{$operation}Envio>";
        $content = $this->sign($content, "{$operation}Envio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
    
    /**
     * Envia LOTE de RPS para emissão de NFSe (ASSINCRONO)
     * @param array $arps Array contendo de 1 a 50 RPS::class
     * @param string $lote Número do lote de envio
     * @return string
     */
    public function recepcionarLoteRps($arps, $lote, $optsimples)
    {
        $operation = 'esRecepcionarLoteRps';
        $xsd = "{$operation}Envio_v01.xsd";
        $countRps = count($arps);
        
        $content = "<es:enviarLoteRpsEnvio "
            . "xmlns:es=\"{$this->wsobj->msgns}\" "
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" "
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$xsd}\">"
            . "<lote>"
            . "<nrLote>$lote</nrLote>"
            . "<qtRps>$countRps</qtRps>"
            . "<nrVersaoXml>{$this->wsobj->version}</nrVersaoXml>"
            . "<prestador>"
            . "<nrCnpj>{$this->config->cnpj}</nrCnpj>"
            . "<nrInscricaoMunicipal>{$this->config->im}</nrInscricaoMunicipal>"
            . "<isOptanteSimplesNacional>{$optsimples}</isOptanteSimplesNacional>"
            . "<idEntidade>{$this->wsobj->entidade}</idEntidade>"
            . "</prestador>"
            . "<listaRps>";
        foreach ($arps as $rps) {
            $rps->config($this->config);
            $content .= $rps->render();
        }
        $content .= "</listaRps>"
            . "</lote>"
            . "</es:enviarLoteRpsEnvio>";
        $content = $this->sign($content, "enviarLoteRpsEnvio");
        Validator::isValid($content, "{$this->xsdpath}/{$xsd}");
        return $this->send($content, $operation);
    }
}

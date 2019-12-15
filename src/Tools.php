<?php

namespace NFePHP\NFSeEquiplano;
/**
 * Class for comunications with NFSe webserver in Nacional Standard
 *
 * @category  Library
 * @package   NFePHP\NFSeEquiplano
 * @copyright NFePHP Copyright (c) 2019
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

class Tools extends BaseTools
{
    
    public function __construct($config, Certificate $cert)
    {
        parent::__construct($config, $cert);
    }
    
    /**
     * @param integer $numero
     * @param integer $motivo
     * @return string
     */
    public function cancelarNfse($numero, $motivo)
    {
        $operation = 'esCancelarNfse';
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        
        $message = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "{$this->prestador}"
            . "<nrNfse>$numero</nrNfse>"
            . "<dsMotivoCancelamento>Cancelamento</dsMotivoCancelamento>"
            . "</es:{$operation}Envio>";
        
        //$content = $this->sign($message, '', '');
        //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
    
    /**
     * @param string $lote
     * @return string
     */
    public function consultarLoteRps($lote)
    {
        $operation = 'esConsultarLoteRps';
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        
        $message = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "{$this->prestador}"
            . "<<nrLoteRps>$numero</<nrLoteRps>"
            . "<dsMotivoCancelamento>Cancelamento</dsMotivoCancelamento>"
            . "</es:{$operation}Envio>";            
        
        //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
    
    /**
     * Consulta NFSe emitidas em um periodo e por tomador (SINCRONO)
     * @param string $dini
     * @param string $dfim
     * @return string
     */
    public function consultarNfse($dini, $dfim)
    {
        $operation = 'esConsultarNfse';
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        
        $message = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "{$this->prestador}"
            . "<periodoEmissao>"
	    . "<dtInicial>$dini</dtInicial>"
	    . "<dtFinal>$dfim</dtFinal>"
	    . "</periodoEmissao>"
            . "</es:{$operation}Envio>";   
        
        
         //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
    
    /**
     * @param integer $numero
     * @param integer $nremissor
     * @return string
     */
    public function consultarNfsePorRps($numero, $nremissor)
    {
        $operation = 'esConsultarNfsePorRps';
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        
        $message = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "<rps>"
	    . "<nrRps>$dini</nrRps>"
	    . "<nrEmissorRps>$dfim</nrEmissorRps>"
	    . "</rps>"
            . "{$this->prestador}"
            . "</es:{$operation}Envio>";   
        
        //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
    
    /**
     * @param integer $lote
     * @return string
     */
    public function consultarSituacaoLoteRps($lote)
    {
        $operation = "esConsultarSituacaoLoteRps";
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        
        $message = "<es:{$operation}Envio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "{$this->prestador}"
            . "<nrLoteRps>$lote</nrLoteRps>"
            . "</es:{$operation}Envio>";   
        
        //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
    
    /**
     * Envia LOTE de RPS para emissão de NFSe (ASSINCRONO)
     * @param array $arps Array contendo de 1 a 50 RPS::class
     * @param string $lote Número do lote de envio
     * @return string
     * @throws \Exception
     */
    public function recepcionarLoteRps($arps, $lote)
    {
        $operation = 'esRecepcionarLoteRps';
        $xsd = "{$this->xsdpath}/{$operation}Envio_v{$this->version}.xsd";
        $ver = (int) $this->version;
        $countRps = count($arps);
        
        $message = "<es:enviarLoteRpsEnvioEnvio "
            . "xmlns:es=\"{$this->wsobj->msgns}\""
            . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" 
            . "xsi:schemaLocation=\"{$this->wsobj->msgns} {$operation}_v{$this->version}.xsd\">"
            . "<lote>"
            . "<nrLote>$lote</nrLote>"
	    . "<qtRps>$countRps</qtRps>"
	    . "<nrVersaoXml>$ver</nrVersaoXml>"
            . "{$this->prestador}"
            . "<listaRps>";
            foreach($arps as $rps) {
                $rps->render();
            }
        $message = "</listaRps>"
            . "<lote>"
            . "</es:enviarLoteRpsEnvioEnvio>";   
        
        //$content = $this->sign($contentmsg, 'LoteRps', 'Id');
        //Validator::isValid($content, $xsd);
        return $this->send($message, $operation);
    }
}
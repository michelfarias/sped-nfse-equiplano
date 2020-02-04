<?php

namespace NFePHP\NFSeEquiplano\Common;

/**
 * Auxiar Tools Class for comunications with NFSe webserver in Equiplano Provider
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
use NFePHP\Common\DOMImproved as Dom;
use NFePHP\NFSeEquiplano\RpsInterface;
use NFePHP\NFSeEquiplano\Common\Signer;
use NFePHP\NFSeEquiplano\Common\Soap\SoapInterface;
use NFePHP\NFSeEquiplano\Common\Soap\SoapCurl;

class Tools
{
    public $lastRequest;
    
    protected $config;
    protected $prestador;
    protected $certificate;
    protected $wsobj;
    protected $soap;
    protected $environment;
    protected $xsdpath;
    
    /**
     * Constructor
     * @param string $config
     * @param Certificate $cert
     */
    public function __construct($config, Certificate $cert)
    {
        $this->config = json_decode($config);
        $this->certificate = $cert;
        $this->xsdpath = realpath(
            __DIR__ . "/../../storage/schemes"
        );
        $this->wsobj = $this->loadWsobj($this->config->cmun);
        $this->buildPrestadorTag();
        $this->environment = 'homologacao';
        if ($this->config->tpamb === 1) {
            $this->environment = 'producao';
        }
    }
    
    /**
     * load webservice parameters
     * @param string $cmun
     * @return object
     * @throws \Exception
     */
    protected function loadWsobj($cmun)
    {
        $path = realpath(__DIR__ . "/../../storage/urls_webservices.json");
        $urls = json_decode(file_get_contents($path), true);
        if (empty($urls[$cmun])) {
            throw new \Exception("Não localizado parâmetros para esse municipio.");
        }
        return (object) $urls[$cmun];
    }


    /**
     * SOAP communication dependency injection
     * @param SoapInterface $soap
     */
    public function loadSoapClass(SoapInterface $soap)
    {
        $this->soap = $soap;
    }
    
    /**
     * Build tag Prestador
     * @return void
     */
    protected function buildPrestadorTag()
    {
        $this->prestador = "<prestador>"
            . "<nrInscricaoMunicipal>{$this->config->im}</nrInscricaoMunicipal>"
            . "<cnpj>{$this->config->cnpj}</cnpj>"
            . "<idEntidade>{$this->wsobj->entidade}</idEntidade>"
            . "</prestador>";
    }

    /**
     * Sign XML passing in content
     * @param string $content
     * @param string $tagname
     * @param string $mark
     * @return string XML signed
     */
    public function sign($content, $tagname, $mark)
    {
        $xml = Signer::sign(
            $this->certificate,
            $content,
            $tagname,
            $mark
        );
        $dom = new Dom('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = false;
        $dom->loadXML($xml);
        return $dom->saveXML($dom->documentElement);
    }
    
    /**
     * Send message to webservice
     * @param string $message
     * @param string $operation
     * @return string XML response from webservice
     */
    public function send($message, $operation)
    {
        $action = "urn:{$operation}";
        
        $url = $this->wsobj->homologacao;
        if ($this->environment === 'producao') {
            $url = $this->wsobj->producao;
        }
        if (empty($url)) {
            throw new \Exception("Não está registrada a URL para o ambiente "
                . "de {$this->environment} desse municipio.");
        }
        $request = $this->createSoapRequest($message, $operation);
        $this->lastRequest = $request;
        
        if (empty($this->soap)) {
            $this->soap = new SoapCurl($this->certificate);
        }
        $msgSize = strlen($request);
        $parameters = [
            "Content-Type: text/xml;charset=UTF-8;action=$action",
            "Content-length: $msgSize"
        ];
        $response = (string) $this->soap->send(
            $operation,
            $url,
            $action,
            $request,
            $parameters
        );
        return $response;
    }

    /**
     * Build SOAP request
     * @param string $message
     * @param string $operation
     * @return string XML SOAP request
     */
    protected function createSoapRequest($message, $operation, $version = null)
    {
        $msg = "<![CDATA[". htmlentities($message, ENT_NOQUOTES) . "]]>";
        $env = "<soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" "
            . "xmlns:ser=\"{$this->wsobj->soapns}\">"
            . "<soap:Header/>"
            . "<soap:Body>"
            . "<ser:{$operation}>";
        if ($version) {
            $env .= "<ser:nrVersaoXml>{$config->versao}</ser:nrVersaoXml>";
        }
        $env .= "<ser:xml>$msg</ser:xml>";
        $env .= "</ser:{$operation}>"
            . "</soap:Body>"
            . "</soap:Envelope>";
        return $env;
    }
}

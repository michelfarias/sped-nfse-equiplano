<?php

namespace NFePHP\NFSeEquiplano\Common;

/**
 * Class for RPS XML convertion
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

use stdClass;
use NFePHP\Common\DOMImproved as Dom;
use DOMNode;
use DOMElement;

class Factory
{
    /**
     * @var stdClass
     */
    protected $std;
    /**
     * @var Dom
     */
    protected $dom;
    /**
     * @var DOMNode
     */
    protected $rps;
    /**
     * @var \stdClass
     */
    protected $config;

    /**
     * Constructor
     * @param stdClass $std
     */
    public function __construct(stdClass $std)
    {
        $this->std = $std;
        
        $this->dom = new Dom('1.0', 'UTF-8');
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = false;
        $this->rps = $this->dom->createElement('rps');
    }
    
    public function addConfig(stdClass $config)
    {
        $this->config = $config;
    }
    
    /**
     * Builder, converts sdtClass Rps in XML Rps
     * NOTE: without Prestador Tag
     * @return string RPS in XML string format
     */
    public function render()
    {
        $this->dom->addChild(
            $this->rps,
            "nrRps",
            $this->std->nrrps,
            true
        );
        $this->dom->addChild(
            $this->rps,
            "nrEmissorRps",
            $this->std->nremissorrps,
            true
        );
        $this->dom->addChild(
            $this->rps,
            "dtEmissaoRps",
            $this->std->dtemissaorps,
            true
        );
        $this->dom->addChild(
            $this->rps,
            "stRps",
            $this->std->strps,
            true
        );
        $this->dom->addChild(
            $this->rps,
            "tpTributacao",
            $this->std->tptributacao,
            true
        );
        $this->dom->addChild(
            $this->rps,
            "isIssRetido",
            $this->std->isissretido,
            true
        );
        
        $this->addTomador();
        $this->addServico();
        
        $this->dom->addChild(
            $this->rps,
            "vlTotalRps",
            number_format($this->std->vltotalrps, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $this->rps,
            "vlLiquidoRps",
            number_format($this->std->vlliquidorps, 2, '.', ''),
            true
        );
        
        $this->addRetencoes();
        
        $this->dom->appendChild($this->rps);
        return str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $this->dom->saveXML());
    }
    
    /**
     * Adiciona o tamador do serviço
     * @return void
     */
    protected function addTomador()
    {
        if (empty($this->std->tomador)) {
            return;
        }
        $tom = $this->std->tomador;
        $tomador = $this->dom->createElement('tomador');
        
        $this->addTomadorDocumento($tomador, $tom);
        
        $this->dom->addChild(
            $tomador,
            "nmTomador",
            $tom->nome,
            true
        );
        $this->dom->addChild(
            $tomador,
            "dsEmail",
            !empty($tom->email) ? $tom->email : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrInscricaoEstadual",
            !empty($tom->ie) ? $tom->ie : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "dsEndereco",
            !empty($tom->logradouro) ? $tom->logradouro : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrEndereco",
            !empty($tom->numero) ? $tom->numero : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "dsComplemento",
            !empty($tom->complemento) ? $tom->complemento : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmBairro",
            !empty($tom->bairro) ? $tom->bairro : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrCidadeIbge",
            !empty($tom->cidade) ? $tom->cidade : null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmUf",
            !empty($tom->uf) ? :  null,
            false
        );
        if ($tom->tpdocumento == 3) {
            $this->dom->addChild(
                $tomador,
                "nmCidadeEstrangeira",
                !empty($tom->cidadeestrangeira) ? $tom->cidadeestrangeira :  null,
                false
            );
        }
        $this->dom->addChild(
            $tomador,
            "nmPais",
            $tom->pais,
            true
        );
        $this->dom->addChild(
            $tomador,
            "nrCep",
            !empty($tom->cep) ? $tom->cep :  null,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrTelefone",
            !empty($tom->telefone) ? $tom->telefone :  null,
            false
        );
        $this->rps->appendChild($tomador);
    }
    
    /**
     * Adiciona o documento do tomador (se houver)
     * @param DOMElement $node
     * @param stdClass $tom
     * @return void
     */
    protected function addTomadorDocumento(&$node, stdClass $tom)
    {
        if (empty($tom->nrdocumento)) {
            return;
        }
        $documento = $this->dom->createElement('documento');
        $this->dom->addChild(
            $documento,
            "nrDocumento",
            $tom->nrdocumento,
            true
        );
        $this->dom->addChild(
            $documento,
            "tpDocumento",
            $tom->tpdocumento,
            true
        );
        $this->dom->addChild(
            $documento,
            "dsDocumentoEstrangeiro",
            !empty($tom->documentoestrangeiro) ? $tom->documentoestrangeiro : null,
            false
        );
        $node->appendChild($documento);
    }

    /**
     * Adiciona os dados do Serviço
     * @return void
     */
    protected function addServico()
    {
        $serv = $this->std->servico;
        $listaServicos = $this->dom->createElement('listaServicos');
        $servico = $this->dom->createElement('servico');
        $this->dom->addChild(
            $servico,
            "nrServicoItem",
            $serv->nrservicoitem,
            true
        );
        $this->dom->addChild(
            $servico,
            "nrServicoSubItem",
            $serv->nrservicosubitem,
            true
        );
        $this->dom->addChild(
            $servico,
            "vlServico",
            number_format($serv->vlservico, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $servico,
            "vlAliquota",
            number_format($serv->vlaliquota, 4, '.', ''),
            true
        );
        
        $this->addDeducao($servico, $serv);
        
        $this->dom->addChild(
            $servico,
            "vlBaseCalculo",
            number_format($this->std->servico->vlbasecalculo, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $servico,
            "vlIssServico",
            number_format($this->std->servico->vlissservico, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $servico,
            "dsDiscriminacaoServico",
            $this->std->servico->discriminacao,
            true
        );
        $listaServicos->appendChild($servico);
        $this->rps->appendChild($listaServicos);
    }
    
    /**
     * Addiciona deduções
     * @param DOMElement $node
     * @param stdClass $serv
     * @return void
     */
    protected function addDeducao(&$node, stdClass $serv)
    {
        if (empty($this->std->servico->deducao)) {
            return;
        }
        $ded = $serv->deducao;
        $deducao = $this->dom->createElement('deducao');
        $this->dom->addChild(
            $deducao,
            "vlDeducao",
            number_format($ded->vldeducao, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $deducao,
            "dsJustificativaDeducao",
            !empty($ded->justificativa) ? $ded->justificativa : null,
            false
        );
        $node->appendChild($deducao);
    }

    /**
     * Adiciona retenções
     * @return void
     */
    protected function addRetencoes()
    {
        if (empty($this->std->retencoes)) {
            return;
        }
        $ret = $this->std->retencoes;
        $sum = $ret->vlcofins + $ret->vlcsll + $ret->vlinss
            + $ret->vlinss + $ret->vlinss + $ret->vlirrf + $ret->vlpis;
        if ($sum == 0) {
            return;
        }
        
        $retencoes = $this->dom->createElement('retencoes');
        $this->dom->addChild(
            $retencoes,
            "vlCofins",
            number_format($ret->vlcofins, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlCsll",
            number_format($ret->vlcsll, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlInss",
            number_format($ret->vlinss, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlIrrf",
            number_format($ret->vlirrf, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlPis",
            number_format($ret->vlpis, 2, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlIss",
            number_format($ret->vliss, 2, '.', ''),
            $this->std->isissretido === 1 ? true : false
        );
        $this->dom->addChild(
            $retencoes,
            "vlAliquotaCofins",
            number_format($ret->vlaliquotacofins, 4, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlAliquotaCsll",
            number_format($ret->vlaliquotacsll, 4, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlAliquotaInss",
            number_format($ret->vlaliquotainss, 4, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlAliquotaIrrf",
            number_format($ret->vlaliquotairrf, 4, '.', ''),
            false
        );
        $this->dom->addChild(
            $retencoes,
            "vlAliquotaPis",
            number_format($ret->vlaliquotapis, 4, '.', ''),
            false
        );
        $this->rps->appendChild($retencoes);
    }
}

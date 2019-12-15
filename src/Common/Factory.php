<?php

namespace NFePHP\NFSeEquiplano\Common;

/**
 * Class for RPS XML convertion
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
        
        $tomador = $this->dom->createElement('tomador');
        $documento = $this->dom->createElement('documento');
        $this->dom->addChild(
            $documento,
            "nrDocumento",
            $this->std->tomador->nrdocumento,
            true
        );
        $this->dom->addChild(
            $documento,
            "tpDocumento",
            $this->std->tomador->tpdocumento,
            true
        );
        $this->dom->addChild(
            $documento,
            "dsDocumentoEstrangeiro",
            $this->std->tomador->dsdocumentoestrangeiro,
            false
        );
        $tomador->appendChild($documento);
        $this->dom->addChild(
            $tomador,
            "nmTomador",
            $this->std->tomador->nmtomador,
            true
        );
        $this->dom->addChild(
            $tomador,
            "dsEmail",
            $this->std->tomador->dsemail,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrInscricaoEstadual",
            $this->std->tomador->nrinscricaoestadual,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrInscricaoMunicipal",
            $this->std->tomador->nrinscricaomunicipal,
            false
        );
        $this->dom->addChild(
            $tomador,
            "dsEndereco",
            $this->std->tomador->dsendereco,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrEndereco",
            $this->std->tomador->nrendereco,
            false
        );
        $this->dom->addChild(
            $tomador,
            "dsComplemento",
            $this->std->tomador->dscomplemento,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmBairro",
            $this->std->tomador->nmbairro,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrCidadeIbge",
            $this->std->tomador->nrcidadeibge,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmUf",
            $this->std->tomador->nmuf,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmCidadeEstrangeira",
            $this->std->tomador->nmcidadeestrangeira,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nmPais",
            $this->std->tomador->nmpais,
            true
        );
        $this->dom->addChild(
            $tomador,
            "nrCep",
            $this->std->tomador->nrcep,
            false
        );
        $this->dom->addChild(
            $tomador,
            "nrTelefone",
            $this->std->tomador->nrtelefone,
            false
        );
        $this->rps->appendChild($tomador);
        
        $listaServicos = $this->dom->createElement('listaServicos');
        $servico = $this->dom->createElement('servico');
        $this->dom->addChild(
            $servico,
            "nrServicoItem",
            $this->std->servico->nrservicoitem,
            true
        );
        $this->dom->addChild(
            $servico,
            "nrServicoSubItem",
            $this->std->servico->nrservicosubitem,
            true
        );
        $this->dom->addChild(
            $servico,
            "vlServico",
            number_format($this->std->servico->vlservico, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $servico,
            "vlAliquota",
            number_format($this->std->servico->vlaliquota, 4, '.', ''),
            true
        );
        if (!empty($this->std->servico->deducao)) {
            $deducao = $this->dom->createElement('deducao');
            $this->dom->addChild(
                $deducao,
                "vlDeducao",
                number_format($this->std->servico->deducao->vldeducao, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $deducao,
                "dsJustificativaDeducao",
                $this->std->servico->deducao->dsjustificativadeducao,
                false
            );
            $servico->appendChild($deducao);
        }
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
            $this->std->servico->dsdiscriminacaoservico,
            true
        );
        $listaServicos->appendChild($servico);
        $this->rps->appendChild($listaServicos);
        
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
        
        if (!empty($this->std->retencoes)) {
            $retencoes = $this->dom->createElement('retencoes');
            $this->dom->addChild(
                $retencoes,
                "vlCofins",
                number_format($this->std->retencoes->vlcofins, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlCsll",
                number_format($this->std->retencoes->vlcsll, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlInss",
                number_format($this->std->retencoes->vlinss, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlIrrf",
                number_format($this->std->retencoes->vlirrf, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlPis",
                number_format($this->std->retencoes->vlpis, 2, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlIss",
                number_format($this->std->retencoes->vliss, 2, '.', ''),
                $this->std->isissretido === 1 ? true : false
            );
            $this->dom->addChild(
                $retencoes,
                "vlAliquotaCofins",
                number_format($this->std->retencoes->vlaliquotacofins, 4, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlAliquotaCsll",
                number_format($this->std->retencoes->vlaliquotacsll, 4, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlAliquotaInss",
                number_format($this->std->retencoes->vlaliquotainss, 4, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlAliquotaIrrf",
                number_format($this->std->retencoes->vlaliquotairrf, 4, '.', ''),
                false
            );
            $this->dom->addChild(
                $retencoes,
                "vlAliquotaPis",
                number_format($this->std->retencoes->vlaliquotapis, 4, '.', ''),
                false
            );
            $this->rps->appendChild($retencoes);
        }
        $this->dom->appendChild($this->rps);
        return $this->dom->saveXML();
    }
}

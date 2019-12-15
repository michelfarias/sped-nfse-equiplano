<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

$version = '01';

$jsonSchema = '{
    "title": "rps",
    "type": "object",
    "properties": {
        "nrversaoxml": {
            "required": true,
            "type": "integer"
        },
        "nrrps": {
            "required": true,
            "type": "integer"
        },
        "nremissorrps": {
            "required": true,
            "type": "integer"
        },
        "dtemissaorps": {
            "required": true,
            "type": "string",
            "pattern": "^([0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T(2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9])$"
        },
        "strps": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 3
        },
        "tptributacao": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 4
        },
        "isissretido": {
            "required": true,
            "type": "integer",
            "minimum": 1,
            "maximum": 2
        },
        "vltotalrps": {
            "required": true,
            "type": "number"
        },
        "vlliquidorps": {
            "required": true,
            "type": "number"
        },
        "tomador": {
            "required": true,
            "type": "object",
            "properties": {
                "nrdocumento": {
                    "required": true,
                    "type": "string",
                    "maxLength": 20
                },
                "tpdocumento": {
                    "required": true,
                    "type": "integer",
                    "minimum": 1,
                    "maximum": 3
                },
                "dsDocumentoEstrangeiro": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 30
                },
                "nmtomador": {
                    "required": true,
                    "type": "string",
                    "maxLength": 80
                },
                "dsemail": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 6,
                    "maxLength": 60
                },
                "nrinscricaoestadual": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 1,
                    "maxLength": 20
                },
                "nrinscricaomunicipal": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{1,20}$"
                },
                "dsendereco": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 0,
                    "maxLength": 40
                },
                "nrendereco": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 0,
                    "maxLength": 10
                },
                "dscomplemento": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 0,
                    "maxLength": 40
                },
                "nmbairro": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 0,
                    "maxLength": 30
                },
                "nrcidadeibge": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{1,7}$"
                },
                "nmuf": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 2
                },
                "nmcidadeestrangeira": {
                    "required": false,
                    "type": ["string","null"],
                    "minLength": 0,
                    "maxLength": 30
                },
                "nmpais": {
                    "required": true,
                    "type": "string",
                    "maxLength": 40
                },
                "nrcep": {
                    "required": false,
                    "type": ["string","null"],
                    "pattern": "^[0-9]{8}$"
                },
                "nrtelefone": {
                    "required": false,
                    "type": ["string","null"],
                    "maxLength": 20
                }
            }
        },
        "servico": {
            "required": true,
            "type": "object",
            "properties": {
                "nrservicoitem": {
                    "required": true,
                    "type": "integer"
                },    
                "nrservicosubitem": {
                    "required": true,
                    "type": "integer"
                },
                "vlservico": {
                    "required": true,
                    "type": "number"
                },
                "vlaliquota": {
                    "required": true,
                    "type": "number"
                },
                "vlbasecalculo": {
                    "required": true,
                    "type": "number"
                },
                "vlissservico": {
                    "required": true,
                    "type": "number"
                },
                "dsdiscriminacaoservico": {
                    "required": true,
                    "type": "string",
                    "maxLength": 1024
                },
                "deducao": {
                    "required": false,
                    "type": ["object","null"],
                    "properties": {
                        "vldeducao": {
                            "required": true,
                            "type": "number"
                        },
                        "dsjustificativadeducao": {
                            "required": true,
                            "type": "string",
                            "maxLength": 255
                        }
                    }
                }
            }
        },    
        "retencoes": {
            "required": false,
            "type": ["object","null"],
            "properties": {
                "vlcofins": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlcsll": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlinss": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlirrf": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlpis": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vliss": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlaliquotacofins": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlaliquotacsll": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlaliquotainss": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlaliquotairrf": {
                    "required": false,
                    "type": ["number","null"]
                },
                "vlaliquotapis": {
                    "required": false,
                    "type": ["number","null"]
                } 
            }    
        }
    }
}';


$std = new \stdClass();
$std->nrversaoxml = 1;
$std->nrrps = 1;
$std->nremissorrps = 1;
$std->dtemissaorps = '2019-08-08T14:58:14';
$std->strps = 1; //1=converter, 2=converter e cancelar NFS, 3=cancelar RPS
$std->tptributacao = 1; //1=tributado no munícipio, 2=em outro munícipio, 3=isento/imune, 4=suspenso/decisão judicial
$std->isissretido = 2; //1=sim, 2=não
$std->vltotalrps = 100.00;
$std->vlliquidorps = 100.00;

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

$std->servico = new \stdClass();
$std->servico->nrservicoitem = 4;
$std->servico->nrservicosubitem = 7;
$std->servico->vlservico = 100.00;
$std->servico->vlaliquota = 0.5;
$std->servico->vlbasecalculo = 100.00;
$std->servico->vlissservico = 5.00;
$std->servico->dsdiscriminacaoservico = 'Teste de Emissao';

//$std->servico->deducao = new \stdClass();
//$std->servico->deducao->vldeducao = 12;
//$std->servico->deducao->dsjustificativadeducao = 'Sem justificativa';

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

// Schema must be decoded before it can be used for validation
$jsonSchemaObject = json_decode($jsonSchema);
if (empty($jsonSchemaObject)) {
    echo "<h2>Erro de digitação no schema ! Revise</h2>";
    echo "<pre>";
    print_r($jsonSchema);
    echo "</pre>";
    die();
}

// The SchemaStorage can resolve references, loading additional schemas from file as needed, etc.
$schemaStorage = new SchemaStorage();
// This does two things:
// 1) Mutates $jsonSchemaObject to normalize the references (to file://mySchema#/definitions/integerData, etc)
// 2) Tells $schemaStorage that references to file://mySchema... should be resolved by looking in $jsonSchemaObject
$schemaStorage->addSchema('file://mySchema', $jsonSchemaObject);
// Provide $schemaStorage to the Validator so that references can be resolved during validation
$jsonValidator = new Validator(new Factory($schemaStorage));
// Do validation (use isValid() and getErrors() to check the result)
$jsonValidator->validate(
    $std,
    $jsonSchemaObject,
    Constraint::CHECK_MODE_COERCE_TYPES  //tenta converter o dado no tipo indicado no schema
);

if ($jsonValidator->isValid()) {
    echo "The supplied JSON validates against the schema.<br/>";
} else {
    echo "Dados não validados. Violações:<br/>";
    foreach ($jsonValidator->getErrors() as $error) {
        echo sprintf("[%s] %s<br/>", $error['property'], $error['message']);
    }
    die;
}

//salva se sucesso
file_put_contents("../storage/jsonSchemes/v$version/rps.schema", $jsonSchema);
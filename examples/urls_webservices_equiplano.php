<?php

$homologacao = "https://www.esnfs.com.br:9444/homologacaows/services/Enfs";
$producao = "https://www.esnfs.com.br:8444/enfsws/services/Enfs";

$msgns = "http://www.equiplano.com.br/esnfs";
$soapns = "http://services.enfsws.es";

$muns = [
    ['Balsa Nova','PR','4102307'],
    ['Cafelândia','PR','4103453'],
    ['Candói','PR','4104428'],
    ['Capanema','PA','1502202'],
    ['Carambeí','PR','4104659'],
    ['Dois Vizinhos','PR','4107207'],
    ['Fernandes Pinheiro','PR','4107736'],
    ['Francisco Beltrão','PR','4108403'],
    ['Guamiranga','PR','4108957'],
    ['Ibaiti','PR','4109708'],
    ['Ibiporã','PR','4109807'],
    ['Imbituva','PR','4110102'],
    ['Ivaí','PR','4111407'],
    ['Laranjeiras do Sul','PR','4113304'],
    ['Missal','PR','4116059'],
    ['Pranchita','PR','4120358'],
    ['Prudentópolis','PR','4120606'],
    ['Quedas do Iguaçu','PR','4120903'],
    ['Realeza','PR','4121406'],
    ['Rio Azul','PR','4122008'],
    ['Rio Branco do Sul','PR','4122206'],
    ['Santo Antônio do Sudoeste','PR','4124400'],
    ['São João','PR','4124806'],
    ['Sengés','PR','4126306'],
    ['Toledo','PR','4127700'],
];

$urls = [];
foreach($muns as $mun) {
    $cod = $mun[2];
    $urls[$cod] = [
        "municipio" => $mun[0],
        "uf" => $mun[1],
        "homologacao" => $homologacao,
        "producao" => $producao,
        "version" => "01",
        "msgns" => $msgns,
        "soapns" => $soapns
    ];
}

$json = json_encode($urls, JSON_PRETTY_PRINT);

file_put_contents('../storage/urls_webservices.json', $json);

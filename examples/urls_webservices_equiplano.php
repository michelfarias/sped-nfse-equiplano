<?php

$homologacao = "https://www.esnfs.com.br:9444/homologacaows/services/Enfs";
$producao = "https://www.esnfs.com.br:8444/enfsws/services/Enfs";

$msgns = "http://www.equiplano.com.br/esnfs";
$soapns = "http://services.enfsws.es";

$muns = [
    ['Balsa Nova','PR','4102307', '23'],
    ['Capanema','PA','1502202', '50'],
    ['Carambeí','PR','4104659', '141'],
    ['Dois Vizinhos','PR','4107207', '68'],
    ['Fernandes Pinheiro','PR','4107736', '140'],
    ['Francisco Beltrão','PR','4108403', '35'],
    ['Ibiporã','PR','4109807', '332'],
    ['Laranjeiras do Sul','PR','4113304', '53'],
    ['Prudentópolis','PR','4120606', '28'],
    ['Rio Azul','PR','4122008', '19'],
    ['Santa Helena', 'PR', '4123501', '54'],
    ['São Jorge D Oeste','PR','4125209', '163'],
    ['Sengés','PR','4126306', '61'],
    ['Telemaco Borba','PR','4127106', '260'],
    ['Toledo','PR','4127700', '136'],
];

$urls = [];
foreach($muns as $mun) {
    $cod = $mun[2];
    $urls[$cod] = [
        "municipio" => $mun[0],
        "uf" => $mun[1],
        "entidade" => $mun[3],
        "homologacao" => $homologacao,
        "producao" => $producao,
        "version" => "1",
        "msgns" => $msgns,
        "soapns" => $soapns
    ];
}

$json = json_encode($urls, JSON_PRETTY_PRINT);

file_put_contents('../storage/urls_webservices.json', $json);

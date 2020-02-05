<?php

$homologacao = "https://www.esnfs.com.br:9444/homologacaows/services/Enfs";
$producao = "https://www.esnfs.com.br:8444/enfsws/services/Enfs";

$msgns = "http://www.equiplano.com.br/esnfs";
$soapns = "http://services.enfsws.es";

//vide https://www.esnfs.com.br/nfsconsultarps.edit.logic

/*
 * ['Ibiporã','PR','4109807', '332'],
    ['Santa Helena', 'PR', '4123501', '54'],
    ['Telemaco Borba','PR','4127106', '260'],
    ['Carambeí','PR','4104659', '141'],
 */

$muns = [
    ['Balsa Nova', 'PR', '4102307', '23'],
    ['Barra do Jacaré', 'PR', '4102703', '29'],
    ['Cafelândia', 'PR', '4103453', '57'],
    ['Cândido de Abreu','PR', '4104402', '108'],
    ['Candói', 'PR', '4104428', '7'],
    ['Cantagalo', 'PR', '4104451', '51'],
    ['Capanema', 'PR', '4104501', '50'],
    ['Conselheiro Mairinck', 'PR', '4106100', '22'],
    ['Cruzeiro do Iguaçu', 'PR', '4106571', '417'],
    ['Dois Vizinhos', 'PR', '4107207', '68'],
    ['Espigão Alto do Iguaçu', 'PR', '4107546', '131'],
    ['Fernandes Pinheiro', 'PR', '4107736', '140'],
    ['Francisco Beltrão', 'PR', '4108403', '35'],
    ['Ibaiti', 'PR', '4109708', '3'],
    ['Imbituva', 'PR', '4110102', '52'],
    ['Inácio Martins', 'PR', '4110201', '88'],
    ['Itaperuçu', 'PR', '4111258', '79'],
    ['Ivaí', 'PR', '4111407', '20'],
    ['Jaboti', 'PR', '4111704', '59'],
    ['Japira', 'PR', '4112306', '44'],
    ['Jataizinho', 'PR', '4112702', '384'],
    ['Jundiaí do Sul', 'PR', '4112900', '41'],
    ['Laranjeiras do Sul', 'PR', '4113304', '53'],
    ['Manfrinópolis', 'PR', '4114351', '150'],
    ['Missal', 'PR', '4116059', '12'],
    ['Nova Laranjeiras', 'PR', '4117057', '76'],
    ['Ouro Verde do Oeste', 'PR', '4117453', '197'],
    ['Palmital', 'PR', '4117800', '38'],
    ['Pinhal de São Bento', 'PR', '4119251', '80'],
    ['Planalto', 'PR', '4119806', '30'],
    ['Porto Barreiro', 'PR', '4120150', '132'],
    ['Pranchita', 'PR', '4120358', '47'],
    ['Quedas do Iguaçu', 'PR', '4120903', '6'],
    ['Realeza', 'PR', '4121406', '49'],
    ['Ribeirão do Pinhal', 'PR', '4121901', '17'],
    ['Rio Azul','PR','4122008', '19'],
    ['Rio Branco do Sul', 'PR','4122206', '18'],
    ['Santo Antonio do Sudoeste', 'PR', '4124400', '58'],
    ['São João', 'PR', '4124806', '48'],
    ['São Jorge D Oeste','PR','4125209', '163'],
    ['São José das Palmeiras', 'PR', '4125456', '382'],
    ['Sapopema', 'PR', '4126207', '113'],
    ['Sengés', 'PR', '4126306', '61'],
    ['Tijucas do Sul', 'PR','4127601', '25'],
    ['Toledo', 'PR', '4127700', '136'],
    ['Turvo', 'PR', '4127965', '69'],
    ['Ventania', 'PR', '4128534', '94'],
    ['Verê', 'PR', '4128609', '72'],
    ['Alvorada do Sul', 'PR', '4100806', '350'],
    ['Curiúva', 'PR', '4107009', '189'],
    ['Foz do Jordão', 'PR', '4108452', '492'],
    ['Ibiporã', 'PR', '4109807', '332'],
    ['Marilândia do Sul', 'PR', '4114906', '750'],
    ['Piên', 'PR', '4119103', '355'],
    ['Porto Amazonas', 'PR', '4120101', '98'],
    ['Prudentópolis','PR','4120606', '28'],
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

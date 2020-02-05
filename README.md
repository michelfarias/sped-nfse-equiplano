# sped-nfse-equiplano

# BETHA TESTES

## Este pacote atende o provedor Equiplano

[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

[![Latest Stable Version][ico-stable]][link-packagist]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![License][ico-license]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

[![Issues][ico-issues]][link-issues]
[![Forks][ico-forks]][link-forks]
[![Stars][ico-stars]][link-stars]


## Municípios atendidos pelo provedor

|n|Município|UF|Ibge|Entidade|
|:---:|:---|:---:|:---:|:---:|
|1|Alvorada do Sul|PR|4100806|350|
|2|Balsa Nova|PR|4102307|23|
|3|Barra do Jacaré|PR|4102703|29|
|4|Cafelândia|PR|4103453|57|
|5|Cândido de Abreu|PR|4104402|108|
|6|Candói|PR|4104428|7|
|7|Cantagalo|PR|4104451|51|
|8|Capanema|PR|4104501|50|
|9|Conselheiro Mairinck|PR|4106100|22|
|10|Cruzeiro do Iguaçu|PR|4106571|417|
|11|Dois Vizinhos|PR|4107207|68|
|12|Espigão Alto do Iguaçu|PR|4107546|131|
|13|Fernandes Pinheiro|PR|4107736|140|
|14|Francisco Beltrão|PR|4108403|35|
|15|Ibaiti|PR|4109708|3|
|16|Imbituva|PR|4110102|52|
|17|Inácio Martins|PR|4110201|88|
|18|Itaperuçu|PR|4111258|79|
|19|Ivaí|PR|4111407|20|
|20|Jaboti|PR|4111704|59|
|21|Japira|PR|4112306|44|
|22|Jataizinho|PR|4112702|384|
|23|Jundiaí do Sul|PR|4112900|41|
|24|Laranjeiras do Sul|PR|4113304|53|
|25|Manfrinópolis|PR|4114351|150|
|26|Missal|PR|4116059|12|
|27|Nova Laranjeiras|PR|4117057|76|
|28|Ouro Verde do Oeste|PR|4117453|197|
|29|Palmital|PR|4117800|38|
|30|Pinhal de São Bento|PR|4119251|80|
|31|Planalto|PR|4119806|30|
|32|Porto Barreiro|PR|4120150|132|
|33|Pranchita|PR|4120358|47|
|34|Quedas do Iguaçu|PR|4120903|6|
|35|Realeza|PR|4121406|49|
|36|Ribeirão do Pinhal|PR|4121901|17|
|37|Rio Azul|PR|4122008|19|
|38|Rio Branco do Sul|PR|4122206|18|
|39|Santo Antonio do Sudoeste|PR|4124400|58|
|40|São João|PR|4124806|48|
|41|São Jorge D Oeste|PR|4125209|163|
|42|São José das Palmeiras|PR|4125456|382|
|43|Sapopema|PR|4126207|113|
|44|Sengés|PR|4126306|61|
|45|Tijucas do Sul|PR|4127601|25|
|46|Toledo|PR|4127700|136|
|47|Turvo|PR|4127965|69|
|48|Ventania|PR|4128534|94|
|49|Verê|PR|4128609|72|
|50|Curiúva|PR|4107009|189|
|51|Foz do Jordão|PR|4108452|492|
|52|Ibiporã|PR|4109807|332|
|53|Marilândia do Sul|PR|4114906|750|
|54|Piên|PR|4119103|355|
|55|Porto Amazonas|PR|4120101|98|
|56|Prudentópolis|PR|4120606|28|


## Observações

- Caonsule sua prefeitura para detlhes de preenchimento do RPS


## Dependências

- PHP >= 7.1
- ext-curl
- ext-soap
- ext-zlib
- ext-dom
- ext-openssl
- ext-json
- ext-simplexml
- ext-libxml

### Outras Libs

- nfephp-org/sped-common
- justinrainbow/json-schema


## Contribuindo
Este é um projeto totalmente *OpenSource*, para usa-lo e modifica-lo você não paga absolutamente nada. Porém para continuarmos a mante-lo é necessário qua alguma contribuição seja feita, seja auxiliando na codificação, na documentação ou na realização de testes e identificação de falhas e BUGs.

**Este pacote está listado no [Packgist](https://packagist.org/)**

*Durante a fase de desenvolvimento e testes este pacote deve ser instalado com:*
```bash
composer require nfephp-org/sped-nfse-equiplano:dev-master
```

*Ou ainda,*
```bash
composer require nfephp-org/sped-nfse-equiplano:dev-master --prefer-dist
```

*Ou ainda alterando o composer.json do seu aplicativo inserindo:*
```json
"require": {
    "nfephp-org/sped-nfse-equiplano" : "dev-master"
}
```

> NOTA: Ao utilizar este pacote ainda na fase de desenvolvimento não se esqueça de alterar o composer.json da sua aplicação para aceitar pacotes em desenvolvimento, alterando a propriedade "minimum-stability" de "stable" para "dev".
> ```json
> "minimum-stability": "dev",
> "prefer-stable": true
> ```

*Após os stable realeases estarem disponíveis, este pacote poderá ser instalado com:*
```bash
composer require nfephp-org/sped-nfse-equiplano
```
Ou ainda alterando o composer.json do seu aplicativo inserindo:
```json
"require": {
    "nfephp-org/sped-sped-nfse-equiplano" : "^1.0"
}
```

## Forma de uso
vide a pasta *Examples*

## Log de mudanças e versões
Acompanhe o [CHANGELOG](CHANGELOG.md) para maiores informações sobre as alterações recentes.

## Testing

Todos os testes são desenvolvidos para operar com o PHPUNIT

## Security

Caso você encontre algum problema relativo a segurança, por favor envie um email diretamente aos mantenedores do pacote ao invés de abrir um ISSUE.

## Credits

Roberto L. Machado (owner and developer)

## License

Este pacote está diponibilizado sob LGPLv3 ou MIT License (MIT). Leia  [Arquivo de Licença](LICENSE.md) para maiores informações.

[ico-stable]: https://poser.pugx.org/nfephp-org/sped-nfse-equiplano/version
[ico-stars]: https://img.shields.io/github/stars/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-forks]: https://img.shields.io/github/forks/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-issues]: https://img.shields.io/github/issues/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nfephp-org/sped-nfse-equiplano/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/nfephp-org/sped-nfse-equiplano.svg?style=flat-square
[ico-license]: https://poser.pugx.org/nfephp-org/nfephp/license.svg?style=flat-square
[ico-gitter]: https://img.shields.io/badge/GITTER-4%20users%20online-green.svg?style=flat-square


[link-packagist]: https://packagist.org/packages/nfephp-org/sped-nfse-equiplano
[link-travis]: https://travis-ci.org/nfephp-org/sped-nfse-equiplano
[link-scrutinizer]: https://scrutinizer-ci.com/g/nfephp-org/sped-nfse-equiplano/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nfephp-org/sped-nfse-equiplano
[link-downloads]: https://packagist.org/packages/nfephp-org/sped-nfse-equiplano
[link-author]: https://github.com/nfephp-org
[link-issues]: https://github.com/nfephp-org/sped-nfse-equiplano/issues
[link-forks]: https://github.com/nfephp-org/sped-nfse-equiplano/network
[link-stars]: https://github.com/nfephp-org/sped-nfse-equiplano/stargazers

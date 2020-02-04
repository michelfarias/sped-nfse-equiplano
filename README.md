# sped-nfse-equiplano

# EM DESENVOVIMENTO NADA ÚTIL

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

|n|Município|UF|Ibge|
|:---:|:---|:---:|:---:|
|Balsa Nova|PR|4102307|
|Cafelândia|PR|4103453|
|Candói|PR|4104428|
|Capanema|PA|1502202|
|Carambeí|PR|4104659|
|Dois Vizinhos|PR|4107207|
|Fernandes Pinheiro|PR|4107736|
|Francisco Beltrão|PR|4108403|
|Guamiranga|PR|4108957|
|Ibaiti|PR|4109708|
|Ibiporã|PR|4109807|
|Imbituva|PR|4110102|
|Ivaí|PR|4111407|
|Laranjeiras do Sul|PR|4113304|
|Missal|PR|4116059|
|Pranchita|PR|4120358|
|Prudentópolis|PR|4120606|
|Quedas do Iguaçu|PR|4120903|
|Realeza|PR|4121406|
|Rio Azul|PR|4122008|
|Rio Branco do Sul|PR|4122206|
|Santo Antônio do Sudoeste|PR|4124400|
|São João|PR|4124806|
|Sengés|PR|4126306|
|Toledo|PR|4127700|


## Observações




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

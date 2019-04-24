# Live eCommerce - Teste para PHP

[![TravisCI][icon-travisci]][link-travisci]
[![Code Coverage][icon-codecov]][link-codecov]

Este repositório contém uma implementação básica de coleções. Coleções armazenam dados pelo esquema de chave-valor, onde um valor é representado por uma chave.

## Teste

Este é um teste para a vaga de desenvolvedor de PHP, na Live eCommerce. Assumimos que se você souber resolver os problemas deste teste, estará apto para assumir responsabilidades maiores.

## Como fazer?

1. Fazer um [fork](https://help.github.com/en/articles/fork-a-repo) deste repositório
2. Vincular* sua conta do GitHub ao [TravisCI](https://travis-ci.org/), para build automatizada, com checagem de sintaxe e testes unitários ([Tutorial](https://hackernoon.com/continuous-integration-using-travis-on-github-1f7f2314b6b7))
3. Vincular sua conta do GitHub ao [CodeCov](https://codecov.io/), para validação de cobertura de teste do código
4. Adicionar a variável de ambiente do CodeCov nas configurações do TravisCI (CODECOV_TOKEN="\<codigo\>")
5. Alterar os links do TravisCI e do CodeCov, que estão no final deste arquivo README, para refletir a url do seu repositório fork
6. Realizar as alterações necessárias pra finalizar as tarefas e requisitos do teste
7. Enviar um email com o link do seu repositório fork, seu CV e os dados de contato para jobs@liveecommerce.com.br

\* Não é necessário configurar o TravisCI, uma vez que o arquivo de configuração já está na raiz do projeto. Só é necessário vincular a conta e habilitar as builds para o seu repositório.

## Tarefas

Para passar neste teste, você deverá realizar algumas tarefas:

> 1. Corrigir um erro de código, inserido voluntariamente, que está impedindo o conclusão dos testes unitários.

> 2. Adicionar uma nova coleção (`FileCollection`), se baseando em leitura e escrita de arquivos, seguindo os moldes da coleção de memória (`MemoryCollection`).
> \
> A coleção deverá utilizar um único arquivo para leitura e escrita, que será fornecido durante a construção do objeto.
> \
> Só há a necessidade de executar a leitura geral do arquivo uma vez por execução do PHP.
> \
> A ideia é que haja uma espécie de "persistência" da coleção, em disco.

> 3. Adicionar tempo de expiração para os registros, nas duas coleções (`FileCollection` e `MemoryCollection`).
> \
> O tempo de expiração será fornecido junto à chamada do método `set`, mas será opcional. Caso não haja o preenchimento, a classe assumirá um valor padrão.
> \
> Se houver a tentativa de obter o valor de um índice expirado, nada deverá ser retornado. O índice deverá ser considerado inexistente, nesta situação.

## Requisitos

- Todo o código criado precisa conter teste unitário;
- A padronização de sintaxe deve ser PSR-2 (https://www.php-fig.org/psr/psr-2/);
- O código precisa estar devidamente documentado, seguindo o padrão dos arquivos atuais;
- A cobertura de código (code-coverage) precisa ser exatamente igual a 100%, ou seja, todo o código do projeto precisa estar coberto por testes;
- Todo código e documentação deve estar em inglês.


# Projeto

## Dependências

Você precisará de:
- PHP7.2+
- XDebug
- Composer

## Instalação

Para instalar as dependências do projeto, utilize o comando, na raiz do projeto:
```
$ composer install
```

## Validações

Para validar a sintaxe do código, utilize o comando, na raiz do projeto:
```
$ composer check
```

Para executar os testes, utilize o comando, na raiz do projeto:
```
$ composer test
```

[icon-travisci]: https://img.shields.io/travis/liveecommerce/php-test.svg?style=flat-square
[icon-codecov]: https://img.shields.io/codecov/c/github/liveecommerce/php-test.svg?style=flat-square

[link-travisci]: https://travis-ci.org/liveecommerce/php-test
[link-codecov]: https://codecov.io/gh/liveecommerce/php-test
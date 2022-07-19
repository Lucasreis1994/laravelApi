Para fazer esse projeto, me baseei no repository pattern, com uma camada de services para efetuar a regra de negócio antes de enviar para os repositories

As Requisições da api com todas as rotas se encontra em: insomniaApi.json

Utilizei o Laravel Sail - https://laravel.com/docs/9.x/sail

O Desafio:
- O usuário precisa informar 3 informações em tela, moeda de destino, valor para conversão e forma de pagamento. A nossa moeda nacional BRL será usada como moeda base na conversão.

As Regras de négocio:
- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
- Para pagamentos em boleto, taxa de 1,45%
- Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

Exemplos de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino:
- Exemplo: USD, BTC, ...
- Valor para conversão:
- Exemplo: 5.000,00, 1.000,00, 70.000,00, ...
- Forma de pagamento:
- Boleto ou Cartão de Crédito

Exemplo de funcionamento:
- Parâmetros de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino: USD
- Valor para conversão: 5.000,00
- Forma de pagamento: Boleto

Parâmetros de saída:
- Moeda de origem: BRL
- Moeda de destino: USD
- Valor para conversão: R$ 5.000,00
- Forma de pagamento: Boleto
- Valor da "Moeda de destino" usado para conversão: $ 5,30
- Valor comprado em "Moeda de destino": $ 920,18 (taxas aplicadas no valor de compra diminuindo no valor total de conversão)
- Taxa de pagamento: R$ 72,50
- Taxa de conversão: R$ 50,00
- Valor utilizado para conversão descontando as taxas: R$ 4.877,50

Critério de aceitação:
- Deve ser possível escolher uma moeda estrangeira entre pelo menos 2 opções sendo o seu valor de compra maior que R$ 1.000 e menor que R$ 100.000,00 e sua forma de pagamento em boleto ou cartão de crédito tendo como resultado o valor que será adquirido na moeda de destino e as taxas aplicadas;


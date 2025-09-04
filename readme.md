# Projeto 1: Simulador de Carrinho de Compras

## Autor
* **Nome:** João Victor Colussi
* **RA:** 2003753

---

## Sobre o Projeto
Este é um projeto simples para a disciplina de **Design Patterns & Clean Code**, que tem como objetivo desenvolver um simulador de carrinho de compras em PHP. O sistema aplica boas práticas de programação como **PSR-12**, **DRY** e **KISS** para simular o fluxo de um e-commerce.

Todos os dados, como produtos e itens do carrinho, são fixos e representados em arrays PHP, sem a necessidade de um banco de dados.

---

## Tecnologias Utilizadas
* **Linguagem:** PHP
* **Ambiente de Execução:** XAMPP

---

## Como Rodar o Projeto

1.  Certifique-se de que o **XAMPP** está instalado em sua máquina.
2.  Abra o painel de controle do XAMPP e inicie o módulo **Apache**.
3.  Crie uma pasta chamada `carrinho` dentro do diretório `htdocs` do XAMPP.
4.  Crie a pasta **Classes** dentro de `carrinho` e salve os arquivos `Cart.php`, `Product.php` e `Stock.php` dentro dela.
5.  Salve o arquivo `index.php` (o arquivo principal) diretamente na pasta `carrinho`.
6.  Abra seu navegador e acesse a URL: `http://localhost/carrinho/index.php`.

---

## Funcionalidades
O sistema simula um carrinho de compras com as seguintes funcionalidades, aplicando validações e regras de negócio simples:
* **Adicionar Item ao Carrinho:** Adiciona um produto ao carrinho após validar se ele existe e se há estoque suficiente.
* **Remover Item do Carrinho:** Remove um produto do carrinho e restaura seu estoque.
* **Listar Itens do Carrinho:** Exibe os produtos adicionados, mostrando a quantidade, subtotal e o total final.
* **Calcular Total:** Soma o valor de todos os itens no carrinho.
* **Aplicar Desconto Fixo:** Aplica um desconto de 10% no total quando o cupom **DESCONTO10** é utilizado.

---

## Exemplos de Uso (Casos de Teste)

O arquivo `index.php` inclui um conjunto de casos de teste para demonstrar as funcionalidades:

1.  **Adição de produto válido:** Adiciona `2x Camiseta` ao carrinho, e o estoque é atualizado.
2.  **Adição além do estoque:** Tenta adicionar `10x Tênis`, resultando em uma mensagem de erro de "Estoque insuficiente".
3.  **Remoção de produto:** Remove uma `Calça Jeans` do carrinho, e o estoque é restaurado.
4.  **Aplicação de cupom:** O cupom `DESCONTO10` é aplicado, reduzindo o valor total em 10%.

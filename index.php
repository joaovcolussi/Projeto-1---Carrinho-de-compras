<?php

require_once 'classes/Cart.php';
require_once 'classes/Stock.php';
require_once 'classes/Product.php';


$productData = [
    ['id' => 1, 'name' => 'Carteira do relampago marquinhos', 'price' => 59.90, 'stock' => 10],
    ['id' => 2, 'name' => 'Blusa do mikey mouse', 'price' => 129.90, 'stock' => 5],
    ['id' => 3, 'name' => 'Short do Barack Obama', 'price' => 199.90, 'stock' => 3]
];

// Instanciando o stock
$stock = new Stock($productData);

//  Instanciando a classe
$cart = new Cart($stock);


echo "<h2>Shopping Cart Simulation (Object-Oriented)</h2>";

// Caso 1 — Usuário adiciona um produto válido
$cart->addItem(1, 2);
echo "<br>";

// Caso 2 — Usuário tenta adicionar além do estoque
$cart->addItem(3, 10);
echo "<br>";

// Listar Items do carrinho
$cart->listItems();
echo "<br>";

// Calculate the total and apply the discount.
$initialTotal = $cart->calculateTotal();
echo "Initial total value (without discount): R$ " . number_format($initialTotal, 2, ',', '.') . "<br>";

// Caso 4 — Aplicação de cupom de desconto.
$totalWithDiscount = $cart->applyDiscount($initialTotal, 'DESCONTO10');
echo "Total value (with coupon DESCONTO10): R$ " . number_format($totalWithDiscount, 2, ',', '.') . "<br>";
echo "<br>";

// Caso 3 — Usuário remove produto do carrinho
$cart->removeItem(1);
echo "<br>";

// Listando depois de remover
$cart->listItems();
echo "<br>";

// Update de estoque
echo "<h3>Updated Stock</h3>";
$stock->listStock();
?>
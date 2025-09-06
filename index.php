<?php

require_once 'classes/Cart.php';
require_once 'classes/Stock.php';
require_once 'classes/Product.php';


$productData = [
    ['id' => 1, 'name' => 'Carteira do relampago marquinhos', 'price' => 59.90, 'stock' => 10],
    ['id' => 2, 'name' => 'Blusa do mikey mouse', 'price' => 129.90, 'stock' => 5],
    ['id' => 3, 'name' => 'Short do Barack Obama', 'price' => 199.90, 'stock' => 3]
];

$stock = new Stock($productData);

$cart = new Cart($stock);


echo "<h2>Shopping Cart Simulation (Object-Oriented)</h2>";

$cart->addItem(1, 2);
echo "<br>";

$cart->addItem(3, 10);
echo "<br>";

$cart->listItems();
echo "<br>";


$initialTotal = $cart->calculateTotal();
echo "Initial total value (without discount): R$ " . number_format($initialTotal, 2, ',', '.') . "<br>";


$totalWithDiscount = $cart->applyDiscount($initialTotal, 'DESCONTO10');
echo "Total value (with coupon DESCONTO10): R$ " . number_format($totalWithDiscount, 2, ',', '.') . "<br>";
echo "<br>";

$cart->removeItem(1);
echo "<br>";

$cart->listItems();
echo "<br>";


echo "<h3>Updated Stock</h3>";
$stock->listStock();
?>
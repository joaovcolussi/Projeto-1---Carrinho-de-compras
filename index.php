<?php

require_once 'classes/Cart.php';
require_once 'classes/Stock.php';
require_once 'classes/Product.php';

// Fixed product data for simulation.
$productData = [
    ['id' => 1, 'name' => 'Carteira do relampago marquinhos', 'price' => 59.90, 'stock' => 10],
    ['id' => 2, 'name' => 'Blusa do mikey mouse', 'price' => 129.90, 'stock' => 5],
    ['id' => 3, 'name' => 'Short do Barack Obama', 'price' => 199.90, 'stock' => 3]
];

// Instantiating the Stock class with product data.
$stock = new Stock($productData);

// Instantiating the Cart class, injecting the Stock dependency.
$cart = new Cart($stock);

// --- Use Case Simulation ---
echo "<h2>Shopping Cart Simulation (Object-Oriented)</h2>";

// Use Case 1: Add a valid product.
$cart->addItem(1, 2);
echo "<br>";

// Use Case 2: Try to add more than the stock allows.
$cart->addItem(3, 10);
echo "<br>";

// List the cart after additions.
$cart->listItems();
echo "<br>";

// Calculate the total and apply the discount.
$initialTotal = $cart->calculateTotal();
echo "Initial total value (without discount): R$ " . number_format($initialTotal, 2, ',', '.') . "<br>";

// Use Case 4: Apply discount coupon.
$totalWithDiscount = $cart->applyDiscount($initialTotal, 'DESCONTO10');
echo "Total value (with coupon DESCONTO10): R$ " . number_format($totalWithDiscount, 2, ',', '.') . "<br>";
echo "<br>";

// Use Case 3: Remove a product from the cart.
$cart->removeItem(1);
echo "<br>";

// List the cart after removal.
$cart->listItems();
echo "<br>";

// Display the updated stock for verification.
echo "<h3>Updated Stock</h3>";
$stock->listStock();
?>
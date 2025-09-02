<?php

//DRY
//KISS
//YAGNI


//Produtos
$products = [
    ['id' => 1, 'name' => 'Pantufas', 'price' => 59.90, 'stock' => 10],
    ['id' => 2, 'name' => 'Colete a prova de bala', 'price' => 129.90, 'stock' => 5],
    ['id' => 3, 'name' => 'Morango do amor', 'price' => 199.90, 'stock' => 3]
];


//Lista do carrinho
$cart = [];


// Procurar produto por id
function findProductById(int $id, array $products): ?array
{
    foreach ($products as $product) {
        if ($product['id'] === $id) {
            return $product;
        }
    }
    return null;
}

// procurar produto por chave de busca
function findCartItemByKey(int $id, array $cart): ?int
{
    foreach ($cart as $key => $item) {
        if ($item['product_id'] === $id) {
            return $key;
        }
    }
    return null;
}


// adicionar ao carrinho
function addItemToCart(int $productId, int $quantity, array &$cart, array &$products): void
{
    $product = findProductById($productId, $products);
    
    // Validações
    if (!$product) {
        echo "Error: Product with ID {$productId} not found.<br>";
        return;
    }

    if ($quantity <= 0 || $quantity > $product['stock']) {
        echo "Error: Insufficient stock for product '{$product['name']}'.<br>";
        return;
    }
    
    $subtotal = $product['price'] * $quantity;
    
    $cart[] = [
        'product_id' => $productId,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    // Atualizar carrinho
    foreach ($products as &$p) {
        if ($p['id'] === $productId) {
            $p['stock'] -= $quantity;
            break;
        }
    }

    echo "{$quantity}x '{$product['name']}' added to cart.<br>";
}

//Função remover do carrinho
function removeItemFromCart(int $productId, array &$cart, array &$products): void
{
    $key = findCartItemByKey($productId, $cart);

    //Validação
    if ($key === null) {
        echo "Error: Product with ID {$productId} not found in the cart.<br>";
        return;
    }
    
    $item = $cart[$key];
    $quantityRemoved = $item['quantity'];

    //Retornar ao estoque
    foreach ($products as &$p) {
        if ($p['id'] === $productId) {
            $p['stock'] += $quantityRemoved;
            break;
        }
    }

    unset($cart[$key]);
    echo "Item removed from cart and stock restored.<br>";
}

function calculateTotal(array $cart): float
{
    $total = 0.0;
    foreach ($cart as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}

function applyDiscount(float $total, string $coupon): float
{
    //desconto simples
    if ($coupon === 'DESCONTO10') {
        return $total * 0.90;
    }
    return $total;
}

function listCartItems(array $cart, array $products): void
{
    echo "<h3>Shopping Cart</h3>";
    if (empty($cart)) {
        echo "The cart is empty.<br>";
        return;
    }
    
    foreach ($cart as $item) {
        $product = findProductById($item['product_id'], $products);
        if ($product) {
            echo "Product: {$product['name']} | Quantity: {$item['quantity']} | Subtotal: R$ " . number_format($item['subtotal'], 2, ',', '.') . "<br>";
        }
    }
}

//Casos de Uso

echo "<h2>Shopping Cart Simulation</h2>";

addItemToCart(1, 2, $cart, $products);
echo "<br>";

addItemToCart(3, 10, $cart, $products);
echo "<br>";

listCartItems($cart, $products);
echo "<br>";

$initialTotal = calculateTotal($cart);
echo "Initial total value (without discount): R$ " . number_format($initialTotal, 2, ',', '.') . "<br>";

$totalWithDiscount = applyDiscount($initialTotal, 'DESCONTO10');
echo "Total value (with coupon DESCONTO10): R$ " . number_format($totalWithDiscount, 2, ',', '.') . "<br>";
echo "<br>";

removeItemFromCart(1, $cart, $products);
echo "<br>";

listCartItems($cart, $products);
echo "<br>";

echo "<h3>Updated Stock</h3>";
foreach ($products as $p) {
    echo "Product: {$p['name']} | Stock: {$p['stock']}<br>";
}
?>
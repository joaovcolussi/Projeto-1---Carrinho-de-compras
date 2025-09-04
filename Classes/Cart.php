<?php

require_once 'Stock.php';
require_once 'Product.php';

class Cart
{
    private Stock $stock;
    private array $items;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
        $this->items = [];
    }

    public function addItem(int $id, int $quantity): void
    {
        $product = $this->stock->getProduct($id);
        
        if (!$product) {
            echo "Error: Product with ID {$id} not found.<br>";
            return;
        }

        if ($this->stock->decreaseQuantity($id, $quantity)) {
            $subtotal = $product->getPrice() * $quantity;
            $this->items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
            echo "{$quantity}x '{$product->getName()}' added to cart.<br>";
        } else {
            echo "Error: Insufficient stock for product '{$product->getName()}'.<br>";
        }
    }

    public function removeItem(int $id): void
    {
        foreach ($this->items as $key => $item) {
            if ($item['product']->getId() === $id) {
                $this->stock->restoreQuantity($id, $item['quantity']);
                unset($this->items[$key]);
                echo "Item '{$item['product']->getName()}' removed from cart and stock restored.<br>";
                return;
            }
        }
        echo "Error: Product with ID {$id} not found in the cart.<br>";
    }

    public function calculateTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['subtotal'];
        }
        return $total;
    }

    public function applyDiscount(float $total, string $coupon): float
    {
        if ($coupon === 'DESCONTO10') {
            return $total * 0.90;
        }
        return $total;
    }

    public function listItems(): void
    {
        echo "<h3>Shopping Cart</h3>";
        if (empty($this->items)) {
            echo "The cart is empty.<br>";
            return;
        }

        foreach ($this->items as $item) {
            echo "Product: {$item['product']->getName()} | Quantity: {$item['quantity']} | Subtotal: R$ " . number_format($item['subtotal'], 2, ',', '.') . "<br>";
        }
    }
}
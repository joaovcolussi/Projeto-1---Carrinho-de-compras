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
        
        if (!$this->isValidProduct($product, $id) || !$this->hasSufficientStock($product, $quantity)) {
            return;
        }

        if ($this->stock->decreaseQuantity($id, $quantity)) {
            $this->createCartItem($product, $quantity);
            $this->printSuccessMessage($product->getName(), $quantity);
        } else {
            $this->printErrorMessage($product->getName());
        }
    }

    public function removeItem(int $id): void
    {
        $itemKey = $this->findItemKey($id);

        if ($itemKey === null) {
            echo "Error: Product with ID {$id} not found in the cart.<br>";
            return;
        }
        
        $item = $this->items[$itemKey];
        $this->stock->restoreQuantity($id, $item['quantity']);
        unset($this->items[$itemKey]);
        echo "Item '{$item['product']->getName()}' removed from cart and stock restored.<br>";
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
    
    
    private function isValidProduct(?Product $product, int $id): bool
    {
        if (!$product) {
            echo "Error: Product with ID {$id} not found.<br>";
            return false;
        }
        return true;
    }
    
    private function hasSufficientStock(Product $product, int $quantity): bool
    {
        if ($quantity <= 0 || $quantity > $this->stock->getQuantity($product->getId())) {
            echo "Error: Insufficient stock for product '{$product->getName()}'.<br>";
            return false;
        }
        return true;
    }
    
    private function createCartItem(Product $product, int $quantity): void
    {
        $subtotal = $product->getPrice() * $quantity;
        $this->items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
    }
    
    private function printSuccessMessage(string $productName, int $quantity): void
    {
        echo "{$quantity}x '{$productName}' added to cart.<br>";
    }
    
    private function printErrorMessage(string $productName): void
    {
        echo "Error: Insufficient stock for product '{$productName}'.<br>";
    }

    private function findItemKey(int $id): ?int
    {
        foreach ($this->items as $key => $item) {
            if ($item['product']->getId() === $id) {
                return $key;
            }
        }
        return null;
    }
}
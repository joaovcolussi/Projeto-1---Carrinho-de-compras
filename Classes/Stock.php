<?php

class Stock
{
    private array $items;

    public function __construct(array $products)
    {
        $this->items = [];
        foreach ($products as $product) {
            $this->items[$product['id']] = ['product' => new Product($product['id'], $product['name'], $product['price']), 'quantity' => $product['stock']];
        }
    }

    public function getProduct(int $id): ?Product
    {
        return $this->items[$id]['product'] ?? null;
    }

    public function getQuantity(int $id): int
    {
        return $this->items[$id]['quantity'] ?? 0;
    }

    public function decreaseQuantity(int $id, int $quantity): bool
    {
        if (isset($this->items[$id]) && $this->items[$id]['quantity'] >= $quantity) {
            $this->items[$id]['quantity'] -= $quantity;
            return true;
        }
        return false;
    }

    public function restoreQuantity(int $id, int $quantity): void
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $quantity;
        }
    }

    public function listStock(): void
    {
        foreach ($this->items as $item) {
            echo "Product: {$item['product']->getName()} | Stock: {$item['quantity']}<br>";
        }
    }
}
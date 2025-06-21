<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct()
    {
        parent::__construct();
        $this->items = session('cart', []);
    }

    private function getTotalPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }

    private function getTotalQuantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->quantity;
        }
        return $total;
    }

    public function add($product, $quantity = 1)
    {
        if (isset($this->items[$product->product_id])) {
            $this->items[$product->product_id]->quantity += $quantity;
        } else {
            $cart_Item = (object) [
                'id' => $product->product_id,
                'img' => $product->main_image_url,
                'name' => $product->product_name,
                'price' => $product->base_price,
                'quantity' => $quantity,
            ];
            $this->items[$product->product_id] = $cart_Item;
        }

        session(['cart' => $this->items]);
    }

    public function removeItem($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            session(['cart' => $this->items]);
        }
    }
}

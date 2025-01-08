<?php

namespace App\Utils;

use App\Models\Products;

class Product {
    protected $products;

    public function __construct(Products $products) {
        $this->products = $products;
    }

    public function get_products () {

    }

    public function get_products_latest () {
        $products =  $this->products->latest()->paginate(3);
        return $products;
    }

    public function get_product ($id) {

    }

    public function create_product () {

    }

    public function update_product ($id) {

    }

    public function delete_product ($id) {

    }
}
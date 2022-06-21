<?php

namespace App\Repositories;

use Config\Database;
use App\Models\Products\Product;
use App\Models\Products\Book;
use App\Models\Products\Dvd;
use App\Models\Products\Furniture;

class ProductRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function insert($post)
    {
        $productType = "App\\Models\\Products\\".ucfirst(mb_strtolower($post['productType']));
        $product = new $productType($this->db);
        $product->setData($post);
        $product->save();
    }

    public function deleteByIds($ids)
    {
        Product::deleteByIds($this->db,$ids);
    }

    public function findAll()
    {
        $products[] = new Book($this->db);
        $products[] = new Dvd($this->db);
        $products[] = new Furniture($this->db);

        $list = array();
        foreach ($products as $product) {
            if ($product instanceof Product) {
                $list = array_merge($list,$product->all());
            }
        }

        usort($list,function($first,$second){
            return $first["id"] <=> $second["id"];
        });

        return $list;
    }
}
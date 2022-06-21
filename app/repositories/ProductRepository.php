<?php
require_once(ROOT . '/app/models/products/Product.php');
require_once(ROOT . '/app/models/products/Book.php');
require_once(ROOT . '/app/models/products/Dvd.php');
require_once(ROOT . '/app/models/products/Furniture.php');
require_once(ROOT . '/config/Db.php');

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
        $productType = ucfirst(mb_strtolower($post['productType']));
        $product = new $productType($this->db);
        $product->setData($post);
        $product->save();
    }

    public function deleteByIds($ids){
        Product::deleteByIds($this->db,$ids);
    }

    public function findAll(){
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
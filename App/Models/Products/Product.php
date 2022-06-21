<?php

namespace App\Models\Products;

use \PDO;
use \PDOException;

abstract class Product
{
    protected $conn;
    private $table_name = "Products";

    private $sku;
    private $name;
    private $price;
    private $productType;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function save()
    {
        $sql = "INSERT INTO $this->table_name (sku, name, price, productType) VALUES (:sku, :name, :price, :productType)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($this->getData());

        return $stmt;
    }

    public function deleteBySKU()
    {
        return $this->conn->prepare("DELETE FROM $this->table_name WHERE sku=?")->execute([$this->getSku()]);
    }

    public static function deleteByIds($conn,$ids)
    {
        $placeholder = str_repeat('?,', count($ids) - 1) . '?';
        return $conn->prepare("DELETE FROM Products WHERE sku in ($placeholder)")->execute($ids);
    }

    abstract public function all();

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getData()
    {
        $data = [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'productType' => $this->productType,
        ];
        return $data;
    }

    public function setData($data)
    {
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->productType = $data['productType'];
    }

}
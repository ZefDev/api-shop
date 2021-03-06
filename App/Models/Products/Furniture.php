<?php

namespace App\Models\Products;

use \PDO;
use \PDOException;

class Furniture extends Product
{
    private $table_name = "furniture";

    private $height;
    private $width;
    private $length;

    public function __construct($db) {
        parent::__construct($db);
    }

    public function save()
    {
        parent::save();

        $sql = "INSERT INTO furniture (sku, height, width, length) VALUES (:sku, :height, :width, :length)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([
            'sku' => $this->getSku(),
            'height' => $this->getHeight(),
            'width' => $this->getLength(),
            'length' => $this->getWidth(),
        ]);

        return $stmt; // TODO: Change the autogenerated stub
    }

    public function all()
    {
        $sql = "SELECT * FROM Products p
        INNER JOIN furniture f ON f.sku = p.sku";

        $statement = $this->conn->query($sql);

        $publishers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $publishers;
    }



    public function deleteBySKU()
    {
        parent::deleteBySKU();
        return $this->conn->prepare("DELETE FROM $this->table_name WHERE sku=?")->execute([$this->getSku()]); // TODO: Change the autogenerated stub
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    public function setData($data)
    {
        parent::setData($data);
        $this->height = $data['height'];
        $this->width = $data['width'];
        $this->length = $data['length'];
    }

}
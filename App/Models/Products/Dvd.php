<?php

namespace App\Models\Products;

use \PDO;
use \PDOException;

class Dvd extends Product
{
    private $table_name = "dvd";
    private $size;

    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function all()
    {
        $sql = "SELECT * FROM Products p
        INNER JOIN dvd d ON d.sku = p.sku";

        $statement = $this->conn->query($sql);

        $publishers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $publishers;
    }

    public function save()
    {
        parent::save();

        $sql = "INSERT INTO dvd (sku, size) VALUES (:sku, :size)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([
            'sku' => $this->getSku(),
            'size' => $this->getSize(),
        ]);

        return $stmt; // TODO: Change the autogenerated stub
    }

    public function deleteBySKU()
    {
        parent::deleteBySKU();

        return $this->conn->prepare("DELETE FROM $this->table_name WHERE sku=?")->execute([$this->getSku()]); // TODO: Change the autogenerated stub
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setData($data)
    {
        parent::setData($data);
        $this->size = $data['size'];
    }


}
<?php

namespace App\Controllers;

use App\Models\Products\Product;
use App\Repositories\ProductRepository;

class ProductController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function actionIndex()
    {
        echo json_encode($this->productRepository->findAll());
    }

    public function actionCreate()
    {
        $this->productRepository->insert($_REQUEST['product']);
    }

    public function actionDelete(){
        $this->productRepository->deleteByIds($_REQUEST['productsIds']);
    }

}
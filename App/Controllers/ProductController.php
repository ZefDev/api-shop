<?php
require_once(ROOT . '/app/repositories/ProductRepository.php');
require_once(ROOT . '/app/models/products/Product.php');

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
        return ;
    }

    public function actionCreate()
    {
        $this->productRepository->insert($_REQUEST['product']);
    }

    public function actionDelete(){
        $this->productRepository->deleteByIds($_REQUEST['productsIds']);
    }

}
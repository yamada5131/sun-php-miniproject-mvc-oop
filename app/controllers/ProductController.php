<?php

use JetBrains\PhpStorm\NoReturn;

require_once(ROOT_DIR.'/app/models/Product.php');

class ProductController
{
    private Product $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
        $this->startSession();
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Display a listing of the products.
     */
    public function index(): void
    {
        $products = $this->productModel->getAllProducts();
        require_once(ROOT_DIR.'/app/views/product/product_list.php');
    }

    public function create(): void
    {
        require_once(ROOT_DIR.'/app/views/product/product_add.php');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Please fill out all required fields.";
            return;
        }
        $productData = $this->getProductDataFromRequest();

        if (!$this->validateProductData($productData)) {
            echo "Please fill out all required fields.";
            return;
        }
        $result = $this->productModel->createProduct($productData);

        if ($result) {
            $this->redirectWithMessage('/index.php?mod=product', 'success_message', 'Product created successfully!');
        } else {
            $this->redirectWithMessage('/index.php?mod=product&act=add', 'error_message', 'Error creating product.');
        }
    }

    private function getProductDataFromRequest(): array
    {
        return [
            'name' => $_POST['name'] ?? '',
            'color' => $_POST['color'] ?? '',
            'category' => $_POST['category'] ?? '',
            'price' => $_POST['price'] ?? '',
            'accessories' => $_POST['accessories'] ?? '',
            'available' => $_POST['available'] ?? '',
            'weight' => $_POST['weight'] ?? '',
        ];
    }

    private function validateProductData(array $data): bool
    {
        foreach ($data as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    #[NoReturn] private function redirectWithMessage(string $url, string $messageType, string $message): void
    {
        $this->setFlashMessage($messageType, $message);
        $this->redirect($url);
    }

    private function setFlashMessage(string $key, string $message): void
    {
        $_SESSION[$key] = $message;
    }

    #[NoReturn] private function redirect(string $url): void
    {
        header("Location: ".$url);
        exit;
    }

    public function remove(): void
    {
        if (!isset($_GET['code'])) {
            echo "ID must be a positive integer";
            return;
        }
        $code = $_GET['code'];
        if ($this->productModel->removeProduct($code)) {
            $this->setFlashMessage('success_message', 'Product deleted successfully!');
        } else {
            $this->setFlashMessage('error_message', 'Error deleting product.');
        }
        $this->redirect('/index.php?mod=product');
    }

    public function edit(): void
    {
        if (!isset($_GET['code'])) {
            echo "Product not found.";
            return;
        }
        $code = $_GET['code'];
        $data = $this->productModel->findProduct($code);
        if (!empty($data)) {
            $product = $data[0];
            require_once(ROOT_DIR.'/app/views/product/product_update.php');
        } else {
            echo "Product not found.";
        }
    }

    public function update(): void
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_GET['code'])) {
            echo "Please fill out all required fields.";
            return;
        }

        $productId = $_GET['code'];
        $productData = $this->getProductDataFromRequest();

        if (!$this->validateProductData($productData)) {
            echo "Please fill out all required fields.";
            return;
        }

        if ($this->productModel->updateProduct($productId, $productData)) {
            $this->redirectWithMessage('/index.php?mod=product', 'success_message', 'Product updated successfully!');
        } else {
            $this->redirectWithMessage('/index.php?mod=product&act=edit', 'error_message', 'Error updating product.');
        }
    }
}

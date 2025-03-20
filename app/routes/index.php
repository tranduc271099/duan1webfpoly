<?php

require_once 'app/config/database.php';


require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/CategoryController.php';


$productController = new ProductController($db);
$categoryController = new CategoryController($db);


$page = isset($_GET['page']) ? $_GET['page'] : 'home';


switch ($page) {
    case 'products':
        $productController->listProducts();
        break;
    case 'product':
        if (isset($_GET['id'])) {
            $productController->viewProduct($_GET['id']);
        } else {
            echo "Sản phẩm không tồn tại!";
        }
        break;
    case 'create_product':
        $productController->createProduct();
        break;
    case 'edit_product':
        if (isset($_GET['id'])) {
            $productController->updateProduct($_GET['id']);
        } else {
            echo "Sản phẩm không tồn tại!";
        }
        break;
    case 'delete_product':
        if (isset($_GET['id'])) {
            $productController->deleteProduct($_GET['id']);
        } else {
            echo "Sản phẩm không tồn tại!";
        }
        break;
    case 'categories':
        $categoryController->listCategories();
        break;
    case 'create_category':
        $categoryController->createCategory();
        break;
    case 'edit_category':
        if (isset($_GET['id'])) {
            $categoryController->updateCategory($_GET['id']);
        } else {
            echo "Danh mục không tồn tại!";
        }
        break;
    case 'delete_category':
        if (isset($_GET['id'])) {
            $categoryController->deleteCategory($_GET['id']);
        } else {
            echo "Danh mục không tồn tại!";
        }
        break;
    default:
        include 'app/views/guest/home.php';
        break;
}

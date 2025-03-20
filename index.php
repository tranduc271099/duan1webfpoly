<?php
// Kết nối cơ sở dữ liệu
require_once 'app/config/database.php';

// Tải các Controller cần thiết
require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/CategoryController.php';


// Khởi tạo Controller với kết nối database
$productController = new ProductController($db);
$categoryController = new CategoryController($db);

// Lấy tham số từ URL
// Đảm bảo rằng các controller đã được import đúng và đường dẫn tới các view cũng chính xác
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'products':
        $productController->listProducts(); // Lấy danh sách sản phẩm từ controller
        break;

    case 'product':
        if (isset($_GET['id'])) {
            $productController->viewProduct($_GET['id']); // Xem chi tiết sản phẩm
        } else {
            echo "Sản phẩm không tồn tại!";
        }
        break;

    case 'categories':
        $categoryController->listCategories();
        break;
    case 'category':
        if (isset($_GET['id'])) {
            $categoryController->viewCategory($_GET['id']); // Xem chi tiết danh mục
        } else {
            echo "Danh mục không tồn tại!";
        }
        break;

    default:
        include 'app/views/guest/list.php'; // Hiển thị trang chủ cho khách hàng
        break;
}

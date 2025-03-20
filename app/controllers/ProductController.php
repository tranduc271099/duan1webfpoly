<?php
require_once './app/models/Product.php';
require_once './app/models/Category.php'; // Import model Category để lấy danh mục

class ProductController
{
    private $db;
    private $productModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->productModel = new Product($db);
    }

    // Liệt kê tất cả sản phẩm
    public function listProducts()
    {
        $products = $this->productModel->getAllProducts();

        // Đảm bảo $products không null khi truyền vào view
        if ($products === null || $products === false) {
            $products = [];
        }

        // Truyền sản phẩm vào view
        include './app/views/admin/products/list.php';
    }

    // Xem chi tiết sản phẩm
    public function viewProduct($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include './app/views/admin/products/detail.php';
        } else {
            echo "Sản phẩm không tồn tại!";
        }
    }

    // Thêm sản phẩm mới
    public function createProduct()
    {
        // Lấy danh sách danh mục để hiển thị trong form
        $categoryModel = new Category($this->db);
        $categories = $categoryModel->getAllCategories();

        // Xử lý nếu form được submit (phương thức POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category_id = $_POST['category_id'];

            // Xử lý upload file ảnh
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'public/uploads/'; // Đường dẫn lưu file

                // Tạo thư mục nếu chưa tồn tại
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Tạo tên file duy nhất
                $image = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $image;

                // Upload file
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image = ''; // Nếu upload thất bại, không lưu ảnh
                    $message = "Có lỗi xảy ra khi tải lên hình ảnh.";
                }
            }

            
            if ($this->productModel->createProduct($name, $price, $description, $image, $quantity, $category_id)) {
                $message = "Sản phẩm đã được thêm thành công!";
                header("Location: index.php?page=products&message=" . urlencode($message));
                exit;
            } else {
                $message = "Lỗi khi thêm sản phẩm!";
            }
        }

        
        include './app/views/admin/products/create.php';
    }

    // Cập nhật sản phẩm
    public function updateProduct($id)
    {
        // Lấy danh sách danh mục để hiển thị trong form
        $categoryModel = new Category($this->db);
        $categories = $categoryModel->getAllCategories();

        // Lấy thông tin sản phẩm cần cập nhật
        $product = $this->productModel->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category_id = $_POST['category_id'];

            // Giữ nguyên ảnh cũ nếu không có file mới
            $image = $product['image'];

            // Xử lý upload file mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'public/uploads/';

                // Tạo thư mục nếu chưa tồn tại
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Xóa file cũ nếu tồn tại
                if (!empty($product['image']) && file_exists($upload_dir . $product['image'])) {
                    unlink($upload_dir . $product['image']);
                }

                // Tạo tên file duy nhất
                $image = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $image;

                // Upload file
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // File uploaded successfully
                } else {
                    $image = $product['image']; // Giữ nguyên ảnh cũ nếu upload thất bại
                    $message = "Có lỗi xảy ra khi tải lên hình ảnh.";
                }
            }

            if ($this->productModel->updateProduct($id, $name, $price, $description, $image, $quantity, $category_id)) {
                $message = "Sản phẩm đã được cập nhật thành công!";
                header("Location: index.php?page=products&message=" . urlencode($message));
                exit;
            } else {
                $message = "Lỗi khi cập nhật sản phẩm!";
            }
        }

        // Truyền danh mục và sản phẩm vào view
        include './app/views/admin/products/edit.php';
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        // Lấy thông tin sản phẩm trước khi xóa
        $product = $this->productModel->getProductById($id);

        if ($this->productModel->deleteProduct($id)) {
            // Xóa file ảnh nếu tồn tại
            if (!empty($product['image'])) {
                $upload_dir = 'public/uploads/';
                $file_path = $upload_dir . $product['image'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $message = "Sản phẩm đã được xóa thành công!";
        } else {
            $message = "Lỗi khi xóa sản phẩm!";
        }

        header("Location: index.php?page=products&message=" . urlencode($message));
        exit;
    }
}
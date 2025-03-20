<?php
// app/controllers/CategoryController.php

require_once './app/models/Category.php';

class CategoryController
{
    private $categoryModel;

    public function __construct($db)
    {
        $this->categoryModel = new Category($db); // Khởi tạo model Category
    }

    // Tạo danh mục
    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            if ($this->categoryModel->createCategory($name)) {
                echo "Danh mục đã được thêm!";
            } else {
                echo "Lỗi khi thêm danh mục!";
            }
        }

        include 'app/views/admin/categories/create.php';
    }

    // Cập nhật danh mục
    public function updateCategory($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            if ($this->categoryModel->updateCategory($id, $name)) {
                echo "Danh mục đã được cập nhật!";
            } else {
                echo "Lỗi khi cập nhật danh mục!";
            }
        }

        // Lấy chi tiết danh mục để hiển thị trong form
        $category = $this->categoryModel->getCategoryById($id);
        include 'app/views/admin/categories/edit.php';
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            echo "Danh mục đã được xóa!";
        } else {
            echo "Lỗi khi xóa danh mục!";
        }
    }

    // Liệt kê danh mục
    public function listCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        include 'app/views/admin/categories/list.php';
    }

    // Xem chi tiết danh mục
    public function viewCategory($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/admin/categories/view.php';
        } else {
            echo "Danh mục không tồn tại!";
        }
    }
}

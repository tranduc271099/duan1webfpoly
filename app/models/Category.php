<?php
// app/models/Category.php

class Category
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getAllCategories()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM categories");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả danh mục
        } catch (PDOException $e) {
            error_log("Lỗi database: " . $e->getMessage()); // Log lỗi nếu có
            return [];
        }
    }


    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin danh mục theo ID
    }


    public function createCategory($name)
    {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        return $stmt->execute([$name]);
    }


    public function updateCategory($id, $name)
    {
        $stmt = $this->db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }


    public function deleteCategory($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

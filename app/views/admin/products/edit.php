<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Chỉnh sửa sản phẩm</h1>
            <a href="index.php?page=products" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <?php if (isset($product) && $product): ?>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?page=products&action=edit&id=<?php echo $product['id']; ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?php echo $product['name']; ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Giá (VNĐ)</label>
                                <input type="number" class="form-control" id="price" name="price" min="0"
                                    value="<?php echo $product['price']; ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" min="0"
                                    value="<?php echo $product['quantity']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php
                                // Giả sử bạn đã lấy danh sách danh mục từ controller
                                // và truyền vào view qua biến $categories
                                if (isset($categories) && is_array($categories)) {
                                    foreach ($categories as $category) {
                                        $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
                                        echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <?php if (!empty($product['image'])): ?>
                                <div class="mb-2">
                                    <img src="public/uploads/<?php echo $product['image']; ?>"
                                        alt="<?php echo $product['name']; ?>" width="100" class="img-thumbnail">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="image" name="image">
                            <div class="form-text">Chọn file hình ảnh mới (JPG, PNG, GIF). Để trống nếu không muốn thay đổi
                                hình ảnh.</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="5"><?php echo $product['description']; ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Không tìm thấy sản phẩm hoặc sản phẩm không tồn tại!
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
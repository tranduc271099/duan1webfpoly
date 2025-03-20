<!-- app/views/admin/products/list.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <!-- Thêm CSS Bootstrap và các plugin cần thiết -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Sản Phẩm</h2>
        <!-- Nút thêm sản phẩm -->
        <a href="index.php?page=create_product" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Thêm Sản Phẩm
        </a>

        <!-- Kiểm tra nếu không có sản phẩm -->
        <?php if (empty($products)): ?>
            <div class="alert alert-info">Không có sản phẩm nào!</div>
        <?php else: ?>
            <!-- Bảng hiển thị sản phẩm -->
            <table id="productTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Mô Tả</th>
                        <th>Danh Mục</th>
                        <th>Số Lượng</th>
                        <th>Hình Ảnh</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['category_id']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td>
                                <!-- Hiển thị ảnh sản phẩm với kích thước nhỏ -->
                                <img src="assets/img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"
                                    width="50">
                            </td>
                            <td>
                                <!-- Các thao tác (Sửa, Xóa) với sản phẩm -->
                                <a href="index.php?page=edit_product&id=<?php echo $product['id']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="index.php?page=delete_product&id=<?php echo $product['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>

    <!-- Thêm các script JS cần thiết -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Khởi tạo bảng với tính năng phân trang và tìm kiếm
        $(document).ready(function() {
            $('#productTable').DataTable({
                "paging": true, // Kích hoạt phân trang
                "searching": true, // Kích hoạt tìm kiếm
                "lengthChange": false, // Tắt thay đổi số lượng hiển thị trên mỗi trang
                "pageLength": 5, // Số lượng sản phẩm hiển thị trên mỗi trang
                "language": {
                    "search": "Tìm kiếm: ",
                    "lengthMenu": "Hiển thị _MENU_ sản phẩm mỗi trang",
                    "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ sản phẩm",
                    "infoEmpty": "Không có sản phẩm nào",
                    "infoFiltered": "(lọc từ _MAX_ sản phẩm)"
                }
            });
        });
    </script>
</body>

</html>
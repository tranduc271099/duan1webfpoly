<!-- app/views/admin/categories/list.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục</title>
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <h2>Danh Sách Danh Mục</h2>

    <a href="index.php?page=create_category" class="btn btn-success">Thêm Danh Mục</a>

    <?php if (empty($categories)): ?>
    <div class="alert alert-info">Không có danh mục nào!</div>
    <?php else: ?>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo $category['name']; ?></td>
                <td>
                    <a href="index.php?page=edit_category&id=<?php echo $category['id']; ?>"
                        class="btn btn-warning">Sửa</a>
                    <a href="index.php?page=delete_category&id=<?php echo $category['id']; ?>"
                        class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(function() {
        $("#example1").DataTable();
    });
    </script>
</body>

</html>
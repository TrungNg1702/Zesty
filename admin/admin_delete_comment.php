<!DOCTYPE html>
<html lang="en">
<head>
    <title>Xoá Người Dùng - Admin Zesty</title>
    <?php
        include_once('../components/assets_admin.php');
        include_once('../components/connection.php');
    ?>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Kiểm tra xem người dùng có tồn tại không // 
            $check_query = "SELECT * FROM danhgia WHERE MaDanhGia = '$id'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Người dùng tồn tại, thực hiện xoá
                $delete_query = "DELETE FROM danhgia WHERE MaDanhGia = '$id'";
                $delete_result = mysqli_query($conn, $delete_query);

                if ($delete_result) {
                    $message = "Xoá đánh giá thành công!";
                    $result = 'success';
                } else {
                    $message = "Lỗi! Không thể xoá đánh giá.";
                    $result = 'danger';
                }
            } else {
                $message = "Đánh giá không tồn tại!";
                $result = 'danger';
            }
        } else {
            $message = "Lỗi! Không có thông tin đánh giá để xoá.";
            $result = 'danger';
        }

        // Đóng kết nối
        mysqli_close($conn);

        // Chuyển hướng về trang admin_users_list.php và truyền thông điệp
        header("Location: admin_comment.php?message=" . urlencode($message) . "&result=" . urlencode($result));
        exit();
    ?>
</body>
</html>

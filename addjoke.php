<?php
if (isset($_POST['joketext'])) {
    try {
        include 'includes/DatabaseConnection.php';

        // --- Xử lý upload ảnh ---
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // tạo thư mục nếu chưa có
            }

            // Tạo tên file duy nhất
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $imageName;

            // Di chuyển file tải lên
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $imagePath = $targetFile;
        }

        // --- Thêm dữ liệu vào cơ sở dữ liệu ---
        $sql = 'INSERT INTO joke 
                (joketext, imagepath, jokedate,authorid)
                VALUES (:joketext, :imagepath, CURDATE(),1)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':imagepath', $imagePath);
        $stmt->execute();

        header('location: jokes.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $title = 'Add a new joke';
    ob_start();
    include 'templates/addjoke.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
?>

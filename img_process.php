<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $randomFileName = uniqid() . '-' . basename($fileName);
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $randomFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">Succces Upload Image</div>';
                    echo '<img src="' . $dest_path . '" class="mt-4 rounded-md shadow-md" alt="Uploaded Image" />';
                    echo '<p class="mb-1 mt-3">URL: <a href="' . $dest_path . '" class="text-blue-500">Click To Look Image</a></p>';
                    echo '<p class="mb-2">Image Name : ' . htmlspecialchars($randomFileName) . '</p>';
                } else {
                    echo '<div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">Error moving the uploaded file.</div>';
                }
            } else {
                echo '<div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-4">No file uploaded or there was an upload error.</div>';
            }
        } else {
            echo '<div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">Invalid request method.</div>';
        }
        ?>
        <a href="index.php" class="mt-4 inline-block text-blue-500">Upload Another Image</a>
    </div>
</body>
</html>
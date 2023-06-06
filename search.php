<?php
include 'connection.php';

$conn = getConnection();
$nama = isset($_GET["nama"]) ? $_GET["nama"] : '';

try {
    $statement = $conn->prepare("SELECT * FROM mahasiswa WHERE nama = :nama;");
    $statement->bindParam(':nama', $nama);
    $statement->execute();
    $hasil = $statement->fetch(PDO::FETCH_ASSOC);

    if ($hasil) {
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        $hasil["message"] = "Nama tidak ada di database";
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
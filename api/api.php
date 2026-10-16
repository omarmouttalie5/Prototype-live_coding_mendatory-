<?php
require_once dirname(__DIR__) . '/models/Product.php';
header('Content-Type: application/json; charset=UTF-8');

$model = new Product();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // error line ->
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'] ?? '';
    $price = $data['price'] ?? '';
    $size = $data['size'] ?? '';

    if (!empty($name) && !empty($price) && !empty($size)) {
        $newItem = $model->add($name, $price, $size);
        echo json_encode(['success' => true, 'data' => $newItem]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    }
} else {
    echo json_encode($model->getAll());
}
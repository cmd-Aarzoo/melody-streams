<?php
session_start();
header('Content-Type: application/json');

$xmlFile = "users.xml";
$xml = simplexml_load_file($xmlFile);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

foreach ($xml->user as $user) {

    $xmlEmail = trim((string)$user->email);
    $xmlPass  = trim((string)$user->password);
    $xmlName  = trim((string)$user->name); // 🔥 IMPORTANT

    if ($xmlEmail === $email) {

        if ($xmlPass === $password) {

            // 🟢 SET SESSION SAFELY
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $xmlEmail;
            $_SESSION['name']  = $xmlName ?: "User"; // fallback in case name missing

            echo json_encode([
                "status" => "success",
                "message" => "Welcome back!"
            ]);
            exit;
        }

        echo json_encode([
            "status" => "error",
            "message" => "Incorrect password, please try again"
        ]);
        exit;
    }
}

echo json_encode([
    "status" => "error",
    "message" => "This email is not registered"
]);
?>

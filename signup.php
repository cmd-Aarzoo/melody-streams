<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // ✅ REQUIRED

header('Content-Type: application/json');

$xmlFile = "users.xml";

if (!file_exists($xmlFile)) {
    file_put_contents($xmlFile, "<?xml version='1.0'?><users></users>");
}

$xml = simplexml_load_file($xmlFile);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';

if (!$name || !$email || !$password) {
    echo json_encode([
        "status"=>"error",
        "message"=>"Please fill in all fields"
    ]);
    exit;
}

// Check existing email
foreach ($xml->user as $user) {
    if ((string)$user->email === $email) {
        echo json_encode([
            "status"=>"error",
            "message"=>"This email is already registered"
        ]);
        exit;
    }
}

// Password strength check
if (strlen($password) < 4) {
    echo json_encode([
        "status"=>"error",
        "message"=>"Password must be at least 4 characters"
    ]);
    exit;
}

// Save new user
$newUser = $xml->addChild("user");
$newUser->addChild("name", $name);
$newUser->addChild("email", $email);
$newUser->addChild("password", $password);

$xml->asXML($xmlFile);

// ✅ STORE IN SESSION (THIS IS STEP 4)
$_SESSION['logged_in'] = true;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;

echo json_encode([
    "status"=>"success",
    "message"=>"Account created successfully!"
]);
?>

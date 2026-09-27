<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$full_name       = trim($_POST["full_name"] ?? "");
$email           = trim($_POST["email"] ?? "");
$phone           = trim($_POST["phone"] ?? "");
$gender          = trim($_POST["gender"] ?? "");
$date_of_birth   = $_POST["date_of_birth"] ?? "";
$student_id      = trim($_POST["student_id"] ?? "");
$degree          = trim($_POST["degree"] ?? "");
$department      = trim($_POST["department"] ?? "");
$graduation_year = $_POST["graduation_year"] ?? "";
$current_job     = trim($_POST["current_job"] ?? "");
$company         = trim($_POST["company"] ?? "");
$city            = trim($_POST["city"] ?? "");
$country         = trim($_POST["country"] ?? "");
$address         = trim($_POST["address"] ?? "");
$password        = $_POST["password"] ?? "";

// Server-side validation
if (
    empty($full_name) || empty($email) ||
    empty($phone) || empty($gender) ||
    empty($date_of_birth) || empty($student_id) ||
    empty($degree) || empty($department) ||
    empty($graduation_year) || empty($city) ||
    empty($country) || empty($password)
) {
    die("Please fill all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

// Check duplicate email
$check = $conn->prepare("SELECT id FROM alumni WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("This email address is already registered.");
}
$check->close();

// Secure password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insert alumni record
$sql = "INSERT INTO alumni
(
    full_name, email, phone, gender, date_of_birth,
    student_id, degree, department, graduation_year,
    current_job, company, city, country, address, password
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssssisssss",
    $full_name, $email, $phone, $gender, $date_of_birth,
    $student_id, $degree, $department, $graduation_year,
    $current_job, $company, $city, $country, $address,
    $password_hash
);

if ($stmt->execute()) {
    echo "Registration successful. Welcome to the Alumni Community. "
       . '<a href="alumni.php">View Alumni Directory</a>';
} else {
    echo "Registration failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
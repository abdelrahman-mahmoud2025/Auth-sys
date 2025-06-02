<?php
session_start();
require_once '../config/database.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "بيانات الدخول غير صحيحة.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-screen px-4">
    <h2 class="text-2xl font-bold mb-4">تسجيل الدخول</h2>
    <p class="mb-2 text-red-500"><?= $msg ?></p>
    <form method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <input name="email" type="email" placeholder="البريد الإلكتروني" required class="w-full mb-3 px-4 py-2 border rounded">
        <input name="password" type="password" placeholder="كلمة المرور" required class="w-full mb-4 px-4 py-2 border rounded">
        <button type="submit" class="bg-gray-800 hover:bg-black text-white px-4 py-2 w-full rounded">دخول</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>

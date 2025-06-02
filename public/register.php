<?php
require_once '../config/database.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    try {
        $stmt->execute([$username, $email, $password]);
        $msg = "تم التسجيل بنجاح! <a class='text-blue-500 underline' href='login.php'>تسجيل الدخول</a>";
    } catch (PDOException $e) {
        $msg = "خطأ: البريد مستخدم بالفعل.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-screen px-4">
    <h2 class="text-2xl font-bold mb-4">تسجيل حساب جديد</h2>
    <p class="mb-2 text-red-500"><?= $msg ?></p>
    <form method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <input name="username" type="text" placeholder="اسم المستخدم" required class="w-full mb-3 px-4 py-2 border rounded">
        <input name="email" type="email" placeholder="البريد الإلكتروني" required class="w-full mb-3 px-4 py-2 border rounded">
        <input name="password" type="password" placeholder="كلمة المرور" required class="w-full mb-4 px-4 py-2 border rounded">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 w-full rounded">تسجيل</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>

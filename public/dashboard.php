<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <h2 class="text-3xl font-bold mb-4">أهلاً، <?= htmlspecialchars($_SESSION['user']['username']) ?> 👋</h2>
    <p class="mb-6 text-gray-600">أنت الآن في لوحة التحكم المحمية.</p>
    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">تسجيل الخروج</a>
</div>
<?php include '../includes/footer.php'; ?>

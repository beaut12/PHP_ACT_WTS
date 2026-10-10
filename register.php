<?php
$pageTitle = "Register | Mi Amor Café";
$bodyClass = "register-page";

$errors = [];
$fullName = "";
$username = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["fullname"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm-password"] ?? "";

    if (!preg_match(
        "/^[\p{L}][\p{L}\s.'-]*$/u",
        $fullName
    )) {
        $errors[] = "Please enter a valid full name.";
    }

    if (!preg_match(
        "/^[A-Za-z0-9_.]{3,20}$/",
        $username
    )) {
        $errors[] =
            "Username must be 3-20 characters using letters, numbers, dots, or underscores.";
    }

    if (!preg_match(
        "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/",
        $email
    )) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!preg_match(
        "/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/",
        $password
    )) {
        $errors[] =
            "Password must be at least 8 characters and contain a letter and a number.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $errors[] =
            "Registration validation successful! No account was saved.";
    }
}

include "includes/header.php";
include "includes/navigation.php";
?>

<main class="page-container">
    <section class="register-card">

        <header class="brand-header">
            <h1>MI AMOR CAFÉ</h1>
            <p>Made with love, served with warmth.</p>
        </header>

        <div class="form-header">
            <h2>Create Your Account</h2>
            <p>Join us for your next favorite cup.</p>
        </div>

        <?php foreach ($errors as $error): ?>
            <p class="validation-message">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endforeach; ?>

        <form action="register.php" method="post">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input
                    type="text"
                    id="fullname"
                    name="fullname"
                    placeholder="Enter your full name"
                    value="<?= htmlspecialchars($fullName) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Choose a username"
                    value="<?= htmlspecialchars($username) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="<?= htmlspecialchars($email) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create a password"
                    required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input
                    type="password"
                    id="confirm-password"
                    name="confirm-password"
                    placeholder="Confirm your password"
                    required>
            </div>

            <button type="submit">Register</button>
        </form>

        <p class="account-link">
            Already have an account?
            <a href="login.php">Login Here</a>
        </p>

    </section>
</main>

<?php include "includes/footer.php"; ?>
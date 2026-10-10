<?php
$pageTitle = "Login | Mi Amor Café";
$bodyClass = "login-page";

$errors = [];
$loginValue = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginValue = trim($_POST["login-email"] ?? "");
    $password = $_POST["login-password"] ?? "";

    $isEmail = preg_match(
        "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/",
        $loginValue
    );

    $isUsername = preg_match(
        "/^[A-Za-z0-9_.]{3,20}$/",
        $loginValue
    );

    if (!$isEmail && !$isUsername) {
        $errors[] =
            "Enter a valid email address or username (3-20 characters).";
    }

    if (!preg_match(
        "/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/",
        $password
    )) {
        $errors[] =
            "Password must be at least 8 characters and contain a letter and a number.";
    }

    if (empty($errors)) {
        $errors[] =
            "Validation successful! No account authentication is configured.";
    }
}

include "includes/header.php";
include "includes/navigation.php";
?>

<main class="page-container">
    <section class="login-card">

        <header class="brand-header">
            <h1>MI AMOR CAFÉ</h1>
            <p>Made with love, served with warmth.</p>
        </header>

        <div class="form-header">
            <h2>Welcome Back</h2>
            <p>Start your cozy morning with us.</p>
        </div>

        <?php foreach ($errors as $error): ?>
            <p class="validation-message">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endforeach; ?>

        <form action="login.php" method="post">

            <div class="form-group">
                <label for="login-email">Email / Username</label>
                <input
                    type="text"
                    id="login-email"
                    name="login-email"
                    placeholder="Enter your email or username"
                    value="<?= htmlspecialchars($loginValue) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>
                <input
                    type="password"
                    id="login-password"
                    name="login-password"
                    placeholder="Enter your password"
                    required>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <a href="#">Forgot password?</a>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="account-link">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </section>
</main>

<?php include "includes/footer.php"; ?>
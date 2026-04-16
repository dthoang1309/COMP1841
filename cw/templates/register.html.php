<h2 style="text-align:center;">Register</h2>

<div class="login-container">
    <form method="post">

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>

        <p style="margin-top:10px;">
            Already have account? 
            <a href="login.php">Login</a>
        </p>
    </form>
</div>
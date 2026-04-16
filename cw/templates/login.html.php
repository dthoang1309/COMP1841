<h2 style="text-align:center;">Login</h2>

<div class="login-container">

    <form method="post">

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <p class="register-link">
            Don't have an account? 
           <a href="register.php">Register</a>
        </p>

    </form>

</div>
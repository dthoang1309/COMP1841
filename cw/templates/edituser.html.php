<link rel="stylesheet" href="/COMP1841/cw/user.css">

<div class="form-container">
    <h2>Edit User</h2>
    <form method="post">  
        <input type="hidden" name="id" value="<?=$user['id']?>">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?=htmlspecialchars($user['username'])?>">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?=htmlspecialchars($user['email'])?>">
        </div>

        <input type="submit" value="Save Changes" class="btn-submit">
    </form>
</div>
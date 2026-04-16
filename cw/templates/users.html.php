<link rel="stylesheet" href="/COMP1841/cw/user.css">

<h2 style="text-align:center; margin-top:20px;">User Management</h2>
<table class="user-table">

    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>

        <td>
            <!-- EDIT -->
            <form action="edituser.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button>Edit</button>
            </form>

            <!-- DELETE -->
            <form method="post" action="adduser.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button name="delete">Delete</button>
            </form>
        
        </td>
    </tr>
    <?php endforeach; ?>

</table>

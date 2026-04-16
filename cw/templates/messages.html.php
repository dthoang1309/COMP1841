<h2>Admin Inbox</h2>

<table class="user-table">
<tr>
    <th>Message</th>
    <th>Date</th>
    <th>Reply</th>
    <th>Action</th>
</tr>

<?php foreach ($messages as $message): ?>
<tr>
    <td><?= htmlspecialchars($message['message']) ?></td>
    <td><?= $message['created_at'] ?></td>
    <td>
        <?= $message['reply'] ? htmlspecialchars($message['reply']) : 'No reply' ?>
    </td>

    <td>
        <!-- REPLY -->
        <form method="post" action="replymessage.php">
            <input type="hidden" name="id" value="<?= $message['id'] ?>">
            <input type="text" name="reply" placeholder="Reply..." required>
            <button type="submit">Reply</button>
        </form>

        <!-- DELETE -->
        <form action="deletemessage.php" method="post">
            <input type="hidden" name="id" value="<?= $message['id'] ?>">
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
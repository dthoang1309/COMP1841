<link rel="stylesheet" href="/COMP1841/cw/review.css">

<h2>Review List</h2>

<table class="user-table">


<tr>
<th>Review</th>
<th>Date</th>
<th>Film</th>
<th>User</th>
<th>Action</th>
</tr>

<?php foreach ($reviews as $review): ?>
<tr>
    <td><?= htmlspecialchars($review['reviewtext']) ?></td>
    <td><?= htmlspecialchars($review['reviewdate']) ?></td>
    <td><?= htmlspecialchars($review['title']) ?></td>
    <td><?= htmlspecialchars($review['username']) ?></td>
    
    <td>
        <?php 
        // Kiểm tra quyền: Là Admin HOẶC là người viết review này
        $canEditDelete = false;
        if ($isAdmin || ($currentUserId !== null && $currentUserId == $review['userid'])) {
            $canEditDelete = true;
        }
        ?>

        <?php if ($canEditDelete): ?>
            <form action="addreview.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $review['id'] ?>">
                <input type="hidden" name="delete" value="1">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this review?')">
            </form>

            <form action="editreview.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $review['id'] ?>">
                <button>Edit</button>
            </form>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

<p>Total reviews: <?= count($reviews) ?></p>

<a href="addreview.php">Add Review</a>
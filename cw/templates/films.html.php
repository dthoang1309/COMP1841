<h2>Film List</h2>

<?php foreach ($films as $film): ?>
   
<div class="card">  
    <img src="images/<?= $film['image'] ?>">

    <div class="card-content">
        <?= $film['title'] ?>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <div class="admin-actions">
            <form method="post" action="film.php" style="margin:0; display:inline;">
                <input type="hidden" name="id" value="<?= $film['id'] ?>">
                <button type="submit" name="delete" class="btn-delete">Delete</button>
            </form>
            
            <form action="editfilm.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $film['id'] ?>">
                <button type="submit" class="btn-edit">Edit</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php endforeach; ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="addfilm.php" class="add-film-btn">+ Add Film</a>
<?php endif; ?>
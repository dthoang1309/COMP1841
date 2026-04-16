<link rel="stylesheet" href="/COMP1841/cw/review.css">
<div class="form-review">
    <h2 class="section-title">Share Your Review</h2>
    
    <form action="addreview.php" method="post">
        <div class="form-group">
            <label>What did you think of the movie?</label>
            <textarea name="reviewtext" rows="5" required placeholder="Write your thoughts here..."></textarea>
        </div>

        <div class="form-group">
            <label>Movie</label>
            <select name="filmid" required>
                <option value="">-- Select a film --</option>
                <?php foreach ($films as $film): ?>
                    <option value="<?= $film['id'] ?>">
                        <?= htmlspecialchars($film['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="userid" value="<?= $_SESSION['user_id'] ?>">

        <button type="submit" class="btn-submit-review">Post Review</button>
    </form>
</div>
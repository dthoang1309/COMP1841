<link rel="stylesheet" href="/COMP1841/cw/review.css">

<div class="form-review">
    <h2 class="section-title">Edit Your Review</h2>
    
    <form action="editreview.php" method="post">
        <input type="hidden" name="id" value="<?= $review['id'] ?>">

        <div class="form-group">
            <label>Your Review</label>
            <textarea name="reviewtext" rows="5" required><?= htmlspecialchars($review['reviewtext']) ?></textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-save">Save Update</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='review.php'">
                Cancel
            </button>
        </div>
    </form>
</div>
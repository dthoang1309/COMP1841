<div class="hero-section">
    <div class="hero-content" style="height: 200px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <a href="film.php" class="btn-primary">Explore All Films</a>
    </div>
</div>

<div class="stats-container">
    <div class="stat-item">
        <h3><?= $totalFilms ?></h3>
        <p>Films Cataloged</p>
    </div>
    <div class="stat-item">
        <h3><?= $totalReviews ?></h3>
        <p>Reviews Shared</p>
    </div>
    <div class="stat-item">
        <h3>Active Community</h3>
        <p>Joined by Users like <?= htmlspecialchars($username) ?></p>
    </div>
</div>

<section class="featured-section">
    <h2 class="section-title">Latest Releases</h2>
    <div class="film-grid">
        <?php foreach ($latestFilms as $film): ?>
            <div class="film-card">
                <div class="film-info">
                    <h3><?= htmlspecialchars($film['title']) ?></h3>
                    <p style="font-style: italic; color: #666;">
                        <?php 
                        $displayText = !empty($film['reviewtext']) 
                                        ? $film['reviewtext'] 
                                        : 'No reviews yet for this movie. Be the first to share your thoughts!';
                        
                        echo substr(htmlspecialchars($displayText), 0, 120) . '...';
                        ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
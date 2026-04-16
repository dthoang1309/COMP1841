<div class="messages-container">
    <h2 class="page-title">My Messages & Replies</h2>

    <?php if (empty($messages)): ?>
        <p class="no-data">You haven't sent any messages yet.</p>
    <?php else: ?>
        <div class="message-list">
            <?php foreach ($messages as $msg): ?>
                <div class="message-card">
                    <div class="user-query">
                        <div class="msg-header">
                            <span class="user-name">Me</span>
                            <span class="msg-date"><?= date('F j, Y, g:i a', strtotime($msg['created_at'])) ?></span>
                        </div>
                        <div class="msg-body">
                            <?= htmlspecialchars($msg['message'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </div>

                    <div class="admin-reply">
                        <?php if (!empty($msg['reply'])): ?>
                            <div class="reply-content">
                                <div class="msg-header">
                                    <span class="admin-name">Admin Support</span>
                                    <span class="msg-date"><?= date('F j, Y, g:i a', strtotime($msg['replied_at'])) ?></span>
                                </div>
                                <div class="msg-body">
                                    <?= htmlspecialchars($msg['reply'], ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="pending-status">Status: <i>Waiting for reply...</i></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
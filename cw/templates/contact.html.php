<div class="form-container">
    <h2>Contact Admin</h2>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
            Message sent successfully!
        </div>
    <?php endif; ?>

    <div style="text-align: center; margin-bottom: 25px;">
        <p>If you have any questions, feel free to reach out.</p>
        <p>Email: <b style="color: #007bff;">admin@gmail.com</b></p>
    </div>

    <div id="contactForm" style="border-top: 1px solid #eee; padding-top: 20px;">
        <form action="sendmessage.php" method="post">
            <div class="form-group">
                <label>Your Message:</label>
                <textarea name="message" rows="5" required placeholder="Type your message here..." 
                          style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-family: inherit; box-sizing: border-box;"></textarea>
            </div>

            <button type="submit" class="btn-save">Send Message</button>
        </form>
    </div>
</div>
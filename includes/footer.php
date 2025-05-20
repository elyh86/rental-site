
<footer>
    <div class="brand">
        <h2>Rydr.</h2>
        <p>Stap in. Rij weg. Simpel.</p>
    </div>
    <div class="footer-links">
        <div class="links">
            <h3>Over ons</h3>
            <ul>
                <li><a href="/over-ons">Het team</a></li>
                <li><a href="#">Onze visie</a></li>
                <li><a href="#">Vacatures</a></li>
            </ul>
        </div>
        <div class="links">
            <h3>Community</h3>
            <ul>
                <li><a href="#">Events</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Podcast</a></li>
                <li><a href="#">Invite a friend</a></li>
            </ul>
        </div>
        <div class="links">
            <h3>Socials</h3>
            <ul>
                <li><a href="#">Discord</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
            </ul>
        </div>
    </div>
</footer>
<div class="legal-footer">
    <div class="legal">
        <div class="copyright">
            © <?= date("Y") ?> Rydr. All rights reserved
        </div>
    </div>
    <div class="legal-links">
        <ul>
            <li><a href="#">Privacy & Policy</a></li>
            <li><a href="#">Terms & Condition</a></li>
        </ul>
    </div>
</div>
<div id="loginModal" class="modal hidden">
    <div class="modal-content">
        <h2>Welkom bij Rydr</h2>
        <p>Kies hoe je verder wilt gaan:</p>
        <div class="modal-actions">
            <a href="/login-form" class="button-secondary">Inloggen</a>
            <a href="/register-form" class="button-primary">Account aanmaken</a>
        </div>
        <button class="modal-close">&times;</button>
    </div>
</div>
<script src="assets/javascript/main.js"></script>

</body>
</html>
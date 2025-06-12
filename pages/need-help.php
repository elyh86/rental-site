<?php require "includes/header.php"; ?>
<main class="help-page">
    <div class="help-container">
        <h1 class="help-title">Hulp nodig?</h1>
        <p class="help-subtitle">Vind snel antwoord op je vraag of neem contact op met ons supportteam.</p>
        <section class="help-faq">
            <h2>Veelgestelde vragen</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">Hoe kan ik een auto huren?</button>
                    <div class="faq-answer">Klik op 'Huur nu' bij de gewenste auto, kies de huurperiode en eventuele extra's, en bevestig je reservering.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Kan ik mijn reservering annuleren?</button>
                    <div class="faq-answer">Neem contact op met onze klantenservice om je reservering te annuleren of te wijzigen.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Wat moet ik meenemen bij het ophalen?</button>
                    <div class="faq-answer">Neem altijd een geldig rijbewijs en een identiteitsbewijs mee. Voor sommige auto's kan een borg gevraagd worden.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Wat als ik pech krijg onderweg?</button>
                    <div class="faq-answer">Bel direct onze pechhulpdienst via het nummer op je huurcontract. Wij helpen je snel weer op weg!</div>
                </div>
            </div>
        </section>
        <section class="help-contact">
            <h2>Contact opnemen</h2>
            <div class="contact-info">
                <p><b>E-mail:</b> <a href="mailto:support@rydr.nl">support@rydr.nl</a></p>
                <p><b>Telefoon:</b> <a href="tel:+31123456789">+31 12 345 6789</a></p>
                <p><b>Openingstijden:</b> Ma t/m Vr 09:00 - 18:00</p>
            </div>
        </section>
    </div>
</main>
<script>
// FAQ accordion effect
const faqBtns = document.querySelectorAll('.faq-question');
faqBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('active');
        const answer = this.nextElementSibling;
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
        } else {
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    });
});
</script>
<?php require "includes/footer.php"; ?> 
// Account dropdown functionaliteit
const accountImage = document.querySelector('.account img');
if (accountImage) {
    accountImage.addEventListener('click', function () {
        const account = this.closest('.account');
        account.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        const account = document.querySelector('.account');
        if (account && !account.contains(e.target)) {
            account.classList.remove('active');
        }
    });
}

// DIRECT NAVIGATIE: Zorg dat het modal NOOIT opent, ongeacht welke knop je klikt
document.addEventListener('DOMContentLoaded', function() {
    // 1. Verberg het login modal definitief
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.style.display = 'none';
        loginModal.remove(); // Verwijder het element volledig uit de DOM
    }
    
    // 2. Override alle eventListeners voor buttons
    document.body.addEventListener('click', function(e) {
        // Als het een knop is met een href attribuut
        if (e.target.tagName === 'A' && e.target.getAttribute('href')) {
            // Voorkom de standaard werking van het modal
            const href = e.target.getAttribute('href');
            if (e.target.hasAttribute('data-direct-link')) {
                e.preventDefault();
                window.location.href = href;
            }
        }
    }, true); // Capture fase - hierdoor worden andere handlers niet uitgevoerd
});

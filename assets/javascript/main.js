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

const startButton = document.querySelector('.button-primary');
if (startButton) {
    startButton.addEventListener('click', function(e) {
        if (window.isLoggedIn === false || window.isLoggedIn === 'false') {
            e.preventDefault();
            const modal = document.getElementById('loginModal');
            if (modal) modal.classList.remove('hidden');
        }
    });
}

const modalClose = document.querySelector('.modal-close');
if (modalClose) {
    modalClose.addEventListener('click', function () {
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.add('hidden');
    });
}

const modal = document.getElementById('loginModal');
if (modal) {
    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}

// Huur nu knop: als ingelogd, ga naar huur-auto pagina
const huurKnoppen = document.querySelectorAll('.button-primary[data-huur-auto-id]');
huurKnoppen.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        if (window.isLoggedIn === true || window.isLoggedIn === 'true') {
            e.preventDefault();
            const carId = btn.getAttribute('data-huur-auto-id');
            window.location.href = '/huur-auto?id=' + encodeURIComponent(carId);
        }
        // Anders: popup wordt al getoond door bestaande code
    });
});

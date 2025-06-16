document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('rentCarForm');
    const cardNumber = document.getElementById('cardNumber');
    const expiryDate = document.getElementById('expiryDate');
    const cvv = document.getElementById('cvv');
    const billingAddress = document.getElementById('billingAddress');

    // Kaartnummer formattering
    cardNumber.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        let formattedValue = '';
        for(let i = 0; i < value.length; i++) {
            if(i > 0 && i % 4 === 0) {
                formattedValue += ' ';
            }
            formattedValue += value[i];
        }
        e.target.value = formattedValue;
    });

    // Vervaldatum formattering
    expiryDate.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if(value.length >= 2) {
            value = value.substring(0,2) + '/' + value.substring(2,4);
        }
        e.target.value = value;
    });

    // CVV validatie
    cvv.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0,3);
    });

    // Factuuradres toggle
    billingAddress.addEventListener('change', function(e) {
        const differentAddressFields = document.querySelectorAll('.billing-address-fields');
        differentAddressFields.forEach(field => {
            field.style.display = e.target.value === 'different' ? 'block' : 'none';
        });
    });

    // Datum validatie
    const pickupDate = document.getElementById('pickupDate');
    const returnDate = document.getElementById('returnDate');

    pickupDate.addEventListener('change', function() {
        const minReturnDate = new Date(this.value);
        minReturnDate.setHours(minReturnDate.getHours() + 1);
        returnDate.min = minReturnDate.toISOString().slice(0,16);
    });

    returnDate.addEventListener('change', function() {
        const maxPickupDate = new Date(this.value);
        maxPickupDate.setHours(maxPickupDate.getHours() - 1);
        pickupDate.max = maxPickupDate.toISOString().slice(0,16);
    });

    // Form validatie
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Voeg de extra's toe aan het formulier
        const extraInsurance = document.getElementById('extraInsurance');
        const childSeat = document.getElementById('childSeat');
        const gps = document.getElementById('gps');
        const winterTires = document.getElementById('winterTires');

        // Maak verborgen velden voor de extra's
        const extraInsuranceInput = document.createElement('input');
        extraInsuranceInput.type = 'hidden';
        extraInsuranceInput.name = 'extra_insurance';
        extraInsuranceInput.value = extraInsurance.checked;
        form.appendChild(extraInsuranceInput);

        const childSeatInput = document.createElement('input');
        childSeatInput.type = 'hidden';
        childSeatInput.name = 'child_seat';
        childSeatInput.value = childSeat.checked;
        form.appendChild(childSeatInput);

        const gpsInput = document.createElement('input');
        gpsInput.type = 'hidden';
        gpsInput.name = 'gps';
        gpsInput.value = gps.checked;
        form.appendChild(gpsInput);

        const winterTiresInput = document.createElement('input');
        winterTiresInput.type = 'hidden';
        winterTiresInput.name = 'winter_tires';
        winterTiresInput.value = winterTires.checked;
        form.appendChild(winterTiresInput);

        // Verstuur het formulier
        form.submit();
    });

    // Extra's prijsberekening
    const extras = document.querySelectorAll('input[type="checkbox"]');
    const totalPrice = document.createElement('div');
    totalPrice.className = 'total-price mt-3';
    form.querySelector('.form-section:last-child').appendChild(totalPrice);

    function updateTotalPrice() {
        let total = 0;
        extras.forEach(extra => {
            if(extra.checked) {
                const price = parseInt(extra.parentElement.textContent.match(/\+€(\d+)/)[1]);
                total += price;
            }
        });
        totalPrice.textContent = `Totale extra kosten: €${total}`;
    }

    extras.forEach(extra => {
        extra.addEventListener('change', updateTotalPrice);
    });
}); 
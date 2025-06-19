document.addEventListener('DOMContentLoaded', function() {
    // Find all favorite icons
    const favoriteIcons = document.querySelectorAll('.favorite-icon');
    
    // Add click event listener to each favorite icon
    favoriteIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get car ID from data attribute
            const carId = this.getAttribute('data-car-id');
            
            // Create form data
            const formData = new FormData();
            formData.append('car_id', carId);
            
            // Send AJAX request
            fetch('/actions/toggle-like.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle active class based on like status
                    if (data.is_liked) {
                        this.classList.add('active');
                    } else {
                        this.classList.remove('active');
                    }
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

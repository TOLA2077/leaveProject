document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myForm');
    const toast = document.getElementById('toast');
    const progressBar = document.querySelector('.progress-bar');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Display the toast notification
        showToast();
        
        // You can add AJAX or fetch request here to submit the form data to process_send_law.php
    });

    function showToast() {
        toast.classList.add('active');
        progressBar.style.animation = 'progress 5s linear forwards';
        setTimeout(function () {
            toast.classList.remove('active');
            progressBar.style.animation = '';
        }, 5000); // 5000 milliseconds = 5 seconds
    }
});

document.addEventListener('DOMContentLoaded', function() {
    let formSubmitted = false;

    const fileInput = document.getElementById('new_profile_image');
    const label = document.querySelector('.profile_edit');

    fileInput.addEventListener('change', () => {
        if (!formSubmitted) {
            formSubmitted = true;
            document.getElementById('profileImageForm').submit(); 
        }
    });

    window.onload = function() {
        formSubmitted = false;
    };
});

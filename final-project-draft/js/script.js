/* Client-side functionality */
document.addEventListener('DOMContentLoaded', function() {
    const newPostBtn = document.getElementById('new-post-btn');
    const settingsPopup = document.getElementById('settings-popup');
    const closeBtn = document.getElementById('close-btn');

    newPostBtn.addEventListener('click', function() {
        settingsPopup.style.display = 'block';
    });

    closeBtn.addEventListener('click', function() {
        settingsPopup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == settingsPopup) {
            settingsPopup.style.display = 'none';
        }
    });
});

function redirectToUserProfile(userId) {
    window.location.href = 'user.php?userId=' + userId;
}
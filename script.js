$(document).ready(function() {
    $('#logout-btn').click(function() {
        if (confirm('Yakin ingin logout?')) {
            window.location.href = 'logout.php';
        }
    });
});


$(document).ready(function () {
    const showWelcome = $('body').data('show-welcome');
    const username = $('body').data('username');

    if (showWelcome === true || showWelcome === 'true') {
        $('#username-placeholder').text(username);
        $('.login-success-message')
            .fadeIn('slow')
            .delay(3000)
            .fadeOut('slow');
    }

    // Toggle password
    const passwordInput = $('#password');
    const toggleIcon = $('#togglePassword');
    if (passwordInput.length && toggleIcon.length) {
        passwordInput.attr('type', 'password');
        toggleIcon.attr('src', 'img/eye.png');
        toggleIcon.attr('alt', 'Tampilkan Password');

        toggleIcon.on('click', function () {
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);

            const icon = type === 'password' ? 'img/eye.png' : 'img/eye-slash.png';
            const altText = type === 'password' ? 'Tampilkan Password' : 'Sembunyikan Password';

            toggleIcon.attr('src', icon);
            toggleIcon.attr('alt', altText);
        });
    }

    if ($('body').data('error') === true || $('body').data('error') === 'true') {
        const box = $('.login-box');
        const errorMessage = $('.error-message');

        box.addClass('shake');
        errorMessage.show();

        setTimeout(() => {
            errorMessage.fadeOut('slow');
            box.removeClass('shake');
        }, 3000);
    }
});

    $(document).ready(function () {
        const showWelcome = $('body').data('show-welcome');
        const username = $('body').data('username');

        if (showWelcome === true || showWelcome === 'true') {
            $('#popup-username').text("Berhasil login, selamat datang " + username + "!");
            $('#welcome-popup').fadeIn();

            setTimeout(() => {
                $('#welcome-popup').fadeOut();
            }, 10000);
        }

        $('#close-popup').click(function () {
            $('#welcome-popup').fadeOut();
        });
    });





















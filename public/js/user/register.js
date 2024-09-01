document.getElementById('togglePassword').addEventListener('click', function () {
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
    const passwordConfirmation = document.getElementById('password_confirmation');
    const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirmation.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

document.getElementById('name').addEventListener('input', function () {
    const name = document.getElementById('name');
    name.value = name.value.charAt(0).toUpperCase() + name.value.slice(1);
});

document.getElementById('password').addEventListener('input', function () {
    const password = document.getElementById('password').value;
    const passwordLengthError = document.getElementById('passwordLengthError');

    if (password.length < 8) {
        passwordLengthError.style.display = 'block';
    } else {
        passwordLengthError.style.display = 'none';
    }
});

document.getElementById('password_confirmation').addEventListener('input', function () {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    const passwordError = document.getElementById('passwordError');

    if (password !== passwordConfirmation) {
        passwordError.style.display = 'block';
    } else {
        passwordError.style.display = 'none';
    }
});

document.getElementById('registerForm').addEventListener('submit', function (event) {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    const passwordError = document.getElementById('passwordError');
    const passwordLengthError = document.getElementById('passwordLengthError');

    if (password.length < 8) {
        event.preventDefault();
        passwordLengthError.style.display = 'block';
    } else {
        passwordLengthError.style.display = 'none';
    }

    if (password !== passwordConfirmation) {
        event.preventDefault();
        passwordError.style.display = 'block';
    } else {
        passwordError.style.display = 'none';
    }
});
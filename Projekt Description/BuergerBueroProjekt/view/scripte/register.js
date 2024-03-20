const form = document.querySelector('form');
const emailInput = document.querySelector('#email');
const passwordInput = document.querySelector('#passwort');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const email = emailInput.value;
    const password = passwordInput.value;

    // Validierung der E-Mail-Adresse
    if (!/\S+@\S+\.\S+/.test(email)) {
        // Fehlermeldung anzeigen
        const emailError = document.createElement('p');
        emailError.classList.add('error');
        emailError.textContent = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
        emailInput.parentNode.appendChild(emailError);

        // Fokus auf das E-Mail-Feld setzen
        emailInput.focus();

        return;
    }

    // Validierung des Passworts
    if (password.length < 8) {
        // Fehlermeldung anzeigen
        const passwordError = document.createElement('p');
        passwordError.classList.add('error');
        passwordError.textContent = 'Das Passwort muss mindestens 8 Zeichen lang sein.';
        passwordInput.parentNode.appendChild(passwordError);

        // Fokus auf das Passwort-Feld setzen
        passwordInput.focus();

        return;
    }

    // Formular absenden
    form.submit();
});

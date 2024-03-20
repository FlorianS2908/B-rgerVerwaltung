// Konstanten für die Formular-Elemente
const formLogin = document.querySelector('#login-form');
const formRegister = document.querySelector('#register-form');

// ---- Validierung der Eingabedaten ----

// Event-Listener für das Submit-Event des Login-Formulars
formLogin.addEventListener('submit', (event) => {
    // Verhindert den Standard-Submit-Vorgang
    event.preventDefault();

    // Abrufen der Werte aus den Eingabefeldern
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;

    // ---- Validierung von username und password ----

    // Wenn username oder password leer sind, Fehlermeldung anzeigen
    if (!username || !password) {
        // Fehlermeldung anzeigen
        console.error('Fehler: Username oder Passwort leer!');
        return;
    }

    // ... (Code für die Anmeldung)
});

// Event-Listener für das Submit-Event des Registrierungs-Formulars
formRegister.addEventListener('submit', (event) => {
    // Verhindert den Standard-Submit-Vorgang
    event.preventDefault();

    // Abrufen der Werte aus den Eingabefeldern
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;
    const password = documentquerySelector('#password').value;
    const confirmPassword = document.querySelector('#confirm-password').value;

    // ---- Validierung von name, email, password und confirmPassword ----

    // Wenn ein Feld leer ist, Fehlermeldung anzeigen
    if (!name || !email || !password || !confirmPassword) {
        // Fehlermeldung anzeigen
        console.error('Fehler: Eingabefelder nicht vollständig!');
        return;
    }

    // ... (Code für die Registrierung)
});

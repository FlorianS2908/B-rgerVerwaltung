function validatRegister() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var date = document.getElementById("geburtsdatum").value;

    // E-Mail-Adresse validieren
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Bitte geben Sie eine gültige E-Mail-Adresse ein.");
        return false;
    }

    // Passwort validieren
    var passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Das Passwort muss mindestens 8 Zeichen lang sein und mindestens einen Großbuchstaben und eine Zahl enthalten.");
        return false;
    }

    // Datum validieren
    var currentDate = new Date();
    var selectedDate = new Date(date);
    if (selectedDate > currentDate) {
        alert("Das Datum darf nicht in der Zukunft liegen.");
        return false;
    }

    // Wenn alle Validierungen erfolgreich sind, wird true zurückgegeben
    return true;
};

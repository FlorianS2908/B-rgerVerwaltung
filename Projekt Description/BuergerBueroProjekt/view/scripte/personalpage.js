document.addEventListener('DOMContentLoaded', function() {
  fetch('../model/Personen.test.json') // Pfad zur JSON-Datei
      .then(response => response.json()) // Parsen der Antwort als JSON
      .then(data => {
          // Suche nach dem Kunden mit der ID 1
          const kunde = data.find(k => k.ID === 1);
          if (kunde) {
              // Setze die Textinhalte der Paragraphen-Elemente
              document.querySelector(".umrandung .text[name='Nachname']").textContent = kunde.Name;
              document.querySelector(".umrandung .text[name='Vorname']").textContent = kunde.Vorname;
              document.querySelector(".umrandung .text[name='Geburtsdatum']").textContent = kunde.Geb.Datum;
              document.querySelector(".umrandung .text[name='Geburtsort']").textContent = kunde.Geb.Ort;
              document.getElementById("Straße").value = kunde.Straße;
              document.getElementById("Hausnummer").value = kunde.Hausnummer;
              document.getElementById("PLZ").value = kunde.PLZ;
              document.getElementById("Ort").value = kunde.Ort;
          } else {
              console.error('Kunde mit der ID 1 nicht gefunden.');
          }
      })
      .catch(error => {
          // Fehlerbehandlung, falls die JSON-Datei nicht geladen werden kann
          console.error('Fehler beim Laden der JSON-Daten:', error);
      });
});

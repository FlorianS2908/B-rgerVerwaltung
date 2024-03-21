document.addEventListener('DOMContentLoaded', function() {
    fetch('../model/PersonenDaten.json')
      .then(response => response.json())
      .then(data => {
        for (var key in data) {
         if (data.hasOwnProperty(key)) {
          
          document.getElementById("Straße").textContent=data[key]["Name"]
          

         }
        }
        
       
        
      })
      .catch(error => console.error('Fehler beim Laden der JSON-Daten:', error));

});
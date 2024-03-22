<div class="menu-icon" id="menuIcon">&#9776;</div>

<!-- Das Dropdown-Menü -->
<div class="dropdown" id="menuDropdown">
    <div class="dropdown-item" onclick="window.location.href='personalpage.php';">Persönliche
        Daten</div>
    <div class="dropdown-item" onclick="window.location.href='anträge.php';">Anträge</div>
    <div class="dropdown-item" onclick="window.location.href='artikel.php';">Artikel</div>
    <div class="dropdown-item" onclick="window.location.href='termine_flo.php';">Termine</div>
    <div class="dropdown-item" onclick="window.location.href='kontakt.php';">Kontakt</div>
</div>

<script>
    // JavaScript, um das Dropdown-Menü anzuzeigen/verbergen
    const menuIcon = document.getElementById("menuIcon");
    const menuDropdown = document.getElementById("menuDropdown");

    menuIcon.addEventListener("click", function() {
        if (menuDropdown.style.display === "block") {
            menuDropdown.style.display = "none";
        } else {
            menuDropdown.style.display = "block";
        }
    });

    // Schließen des Dropdown-Menüs, wenn außerhalb geklickt wird
    window.addEventListener("click", function(event) {
        if (event.target !== menuIcon && event.target !== menuDropdown) {
            menuDropdown.style.display = "none";
        }
    });
</script>
<main>
    <section class="container">
        <h1>Anträge</h1>
        <div>
            <div>
                <p>
                    Hier finden sie verschiedenste Anträge zu Ihren persönlichen Anliegen
                </p>
            </div>
            <div>
                <label for="abteilung">Wählen sie die passende Behörde aus</label>
                <select id="abteilung" onchange="handleSelection()"></select>
                <option value="" disabled selected>Bitte wählen</option>
                <div id="antr-list">
                    <h3 id="grupe-name">Führerscheinstelle</h3>
                    <div class="elements-container">
                        <ul id="elements" class="antrag-list">
                            <li class="antrag-element">
                                <span>Antrag auf Fahreignung</span>
                                <a class="button" href="#">Klicken Sie hier...</a>
                            </li>
                            <li class="antrag-element">
                                <span>Antrag auf Fahreignung</span>
                                <a class="button" href="#">Klicken Sie hier...</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr />
            </div>
    </section>
</main>
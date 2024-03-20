const antrageList = fetch("./../model/AnträgeMockup.json").then((response) =>
  response.json()
);

function populateSelect() {
  antrageList
    .then((data) => {
      const uniqueGruppen = [...new Set(data.map((item) => item.Gruppe))];

      const gruppeNameElement = document.getElementById("grupe-name");
      const select = document.getElementById("abteilung");
      uniqueGruppen.forEach((gruppe) => {
        const option = document.createElement("option");
        option.value = gruppe;
        option.textContent = gruppe;
        select.appendChild(option);
      });
      gruppeNameElement.innerText = select.value;

      const selectedElements = data.filter(
        (item) => item.Gruppe === select.value
      );

      const container = document.getElementById("elements");
      container.innerHTML = "";

      selectedElements.forEach((item) => {
        const listItem = document.createElement("li");
        listItem.classList.add("antrag-element");

        const span = document.createElement("span");
        span.textContent = item.Name ? item.Name : `Antrag Name von Gruppe ${item.Gruppe}`;

        const link = document.createElement("a");
        link.href = item.Link;
        link.textContent = "Klicken Sie hier...";
        link.target = "_blank";
        link.classList.add("button");
        

        listItem.appendChild(span);
        listItem.appendChild(link);
        container.appendChild(listItem);
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
}

window.onload = populateSelect;

function handleSelection() {
  const selectElement = document.getElementById("abteilung");
  const gruppeNameElement = document.getElementById("grupe-name");

  gruppeNameElement.innerText = selectElement.value;

  const container = document.getElementById("elements");
  container.innerHTML = "";

  antrageList
    .then((data) => {
      const selectedElements = data.filter(
        (item) => item.Gruppe === selectElement.value
      );

      selectedElements.forEach((item) => {
        const listItem = document.createElement("li");
        listItem.classList.add("antrag-element");

        const span = document.createElement("span");
        span.textContent = item.Name ? item.Name : `Antrag Name von Gruppe ${item.Gruppe}`;

        const link = document.createElement("a");
        link.href = item.Link;
        link.textContent = "Klicken Sie hier...";
        link.target = "_blank";
        link.classList.add("button");
        
        listItem.appendChild(span);
        listItem.appendChild(link);
        container.appendChild(listItem);
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
}

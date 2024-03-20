let antragParams;

function getParameters() {
  const url = window.location.href;
  const query = url.split("?")[1];
  const params = new URLSearchParams(query);

  const antragId = params.get("id");
  id = antragId;

  fetch("../model/AnträgeMockupNewVersion.json")
    .then((response) => response.json())
    .then((data) => {
      const antrag = data.filter((item) => item.id == params.get("id"))[0];
      antragParams = {
        id: antrag.id,
        name: antrag.name,
        gruppe: antrag.Gruppe,
        link: antrag.Link,
        desc: antrag.Description
      }

      const titleElement = document.getElementById('antrag-title');
      titleElement.innerHTML = '';
      titleElement.textContent = antragParams.name;

      const descriptionElement = document.getElementById('antrag-desc');
      descriptionElement.innerHTML = '';
      descriptionElement.textContent = antragParams.desc;
    })
    .catch((error) => console.error("Error fetching data:", error));
}

window.onload = getParameters;

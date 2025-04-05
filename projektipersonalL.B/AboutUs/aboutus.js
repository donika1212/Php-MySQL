document.addEventListener("DOMContentLoaded", function() {
    const valuesSection = document.getElementById("values");
    const valuesList = valuesSection.querySelector("ul");
    
    valuesSection.addEventListener("click", function() {
        valuesList.classList.toggle("show-values");
    });
});

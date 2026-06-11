export function initIngredientsManager(ingredientsList) {
    let index = 1;

    const container = document.getElementById("ingredients-container");
    const addBtn = document.getElementById("add-ingredient");

    if (!container || !addBtn) return;

    addBtn.addEventListener("click", function () {
        const row = document.createElement("div");
        row.classList.add("ingredient-row", "mb-3", "d-flex", "gap-2");

        let options = "";

        ingredientsList.forEach((ingredient) => {
            options += `<option value="${ingredient.id}">${ingredient.name}</option>`;
        });

        row.innerHTML = `
            <select name="ingredients[${index}][id]" class="form-select">
                ${options}
            </select>

            <input type="text"
                   name="ingredients[${index}][quantity]"
                   class="form-control"
                   placeholder="Quantità">

            <button type="button" class="btn btn-danger remove-ingredient">✕</button>
        `;

        container.appendChild(row);
        index++;
    });

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-ingredient")) {
            e.target.parentElement.remove();
        }
    });
}

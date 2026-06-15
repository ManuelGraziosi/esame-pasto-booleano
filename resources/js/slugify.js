export function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "-") // Sostituisce gli spazi con -
        .replace(/[^\w\-]+/g, "") // Rimuove i caratteri speciali non alfanumerici (eccetto - e _)
        .replace(/\-+/g, "-") // Evita trattini doppi consecutivi (---)
        .replace(/^-+|-+$/g, ""); // Rimuove eventuali trattini all'inizio o alla fine
}

export function initSlugify() {
    const nameInput = document.querySelector('[name="name"]');
    const slugInput = document.querySelector('[name="slug"]');

    if (!nameInput || !slugInput) return;

    nameInput.addEventListener("input", function () {
        slugInput.value = slugify(this.value);
    });
}

export function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "_")
        .replace(/[^\w\-]+/g, "")
        .replace(/\_+/g, "_");
}

export function initSlugify() {
    const nameInput = document.querySelector('[name="name"]');
    const slugInput = document.querySelector('[name="slug"]');

    if (!nameInput || !slugInput) return;

    nameInput.addEventListener("input", function () {
        slugInput.value = slugify(this.value);
    });
}

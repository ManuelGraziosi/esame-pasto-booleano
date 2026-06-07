import "~resources/scss/app.scss";
import "~icons/bootstrap-icons.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

import { initSlugify } from "./slugify";

document.addEventListener("DOMContentLoaded", () => {
    initSlugify();
});

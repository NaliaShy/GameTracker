const toggle = document.getElementById("darkSwitch");
toggle.addEventListener("change", () => {
    document.body.classList.toggle("dark-mode", toggle.checked);
});

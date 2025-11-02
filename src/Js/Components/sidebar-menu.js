 document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const menuIcon = document.getElementById("menu-icon");

    function toggleMenu() {
      sidebar.classList.toggle("active");
      overlay.classList.toggle("show");
      menuIcon.classList.toggle("hide");
    }

    overlay.addEventListener("click", toggleMenu);
    window.toggleMenu = toggleMenu;
  });
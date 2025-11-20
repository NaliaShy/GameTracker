function openSeccion() {
    const Login = document.getElementById("loginModal");
    const overlay = document.getElementById("overlay");
    Login.classList.add("active");
    overlay.classList.add("active");
}

function openCuenta() {
    const Cuenta = document.getElementById("registerModal");
    const overlay = document.getElementById("overlay");
    Cuenta.classList.add("active");
    overlay.classList.add("active");
}

document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById('overlay');
    const Cuenta = document.getElementById('registerModal');
    const Login = document.getElementById('loginModal');

    overlay.addEventListener("click", () => {
        overlay.classList.remove('active');
        Cuenta.classList.remove('active');
        Login.classList.remove('active');  
    });
});

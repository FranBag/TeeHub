document.addEventListener("DOMContentLoaded", () => {
    
    const loginForm = document.getElementById("login-form");
    const usernameInput = document.getElementById("login-username");
    const passwordInput = document.getElementById("login-password");

    function showError(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "crimson",
            },
        }).showToast();
    }

    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;

        try {
            if (validator.isEmpty(username)) {
                throw new Error("Ingrese un nombre de usuario.");
            }

            if (!validator.isLength(password)) {
                throw new Error("Ingrese una contraseña.");
            }

            Toastify({
                text: `¡Te has logeado correctamente. Bienvenido ${username}!`,
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, royalblue, slateblue)", // Tonos azules
                }
            }).showToast();

        } catch (error) {
            showError(error);
        }

    });
});
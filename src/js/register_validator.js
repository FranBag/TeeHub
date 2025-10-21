document.addEventListener("DOMContentLoaded", () => {
    
    const registerForm = document.getElementById("register-form");
    const usernameInput = document.getElementById("register-username");
    const emailInput = document.getElementById("register-email");
    const playernameInput = document.getElementById("register-playername");
    const passwordInput = document.getElementById("register-password");
    const repeatPasswordInput = document.getElementById("register-repeatpassword");

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

    registerForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const username = usernameInput.value;
        const email = emailInput.value;
        const playername = playernameInput.value;
        const password = passwordInput.value;
        const repeatPassword = repeatPasswordInput.value;

        try {
            if (validator.isEmpty(username)) {
                throw new Error("El nombre de usuario no puede estar vacío.");
            }

            if (!validator.isLength(username, { min: 3, max: 20 })) {
                throw new Error("El nombre de usuario debe tener entre 3 y 20 caracteres.");
            }

            if (!validator.isEmail(email)) {
                throw new Error("Por favor, introduce un correo electrónico válido.");
            }

            if (validator.isEmpty(playername)) {
                throw new Error("El nombre de jugador no puede estar vacío.");
            }

            if (!validator.isLength(password, { min: 8 })) { // Usar isStrongPassword en el futuro
                throw new Error("La contraseña debe tener al menos 8 caracteres.");
            }

            if (validator.isEmpty(repeatPassword)) {
                throw new Error("Debes confirmar la contraseña.");
            }
            if (!validator.equals(password, repeatPassword)) {
                throw new Error("Las contraseñas no coinciden.");
            }
        } catch (error) {
            showError(error);
        }

    });
});
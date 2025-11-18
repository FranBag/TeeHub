document.addEventListener("DOMContentLoaded", () => {
    
    const loginForm = document.getElementById("login-form");
    const usernameInput = document.getElementById("login-username");
    const passwordInput = document.getElementById("login-password");

    function showMessage(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, royalblue, slateblue)", // Tonos azules
            }
        }).showToast();
    }

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

            if (validator.isEmpty(password)) {
                throw new Error("Ingrese una contraseña.");
            }

            const url = "../routers/user_router.php";

            const user_data = {
                username: username,
                user_pass: password,
            };
            const form_body = new URLSearchParams(user_data).toString();

            fetch(url.concat("?action=login"), {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: form_body
            })
            .then(response => {
                if(!response.ok) {
                    throw new Error(response.status);
                }
                return response.json();
            })
            .then(data => {
                if(!(data.status === "success")) {
                    throw new Error(data.message);
                }
                console.log(data)
                showMessage(data.message);
            })
            .catch(error => {
                showError(error);
            });
        } catch (error) {
            showError(error);
        }

    });
});
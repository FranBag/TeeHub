document.addEventListener("DOMContentLoaded", async () => {
    const params = new URLSearchParams(window.location.search);
    const playerName = params.get("player_name");

    const apiURL = `https://ddstats.tw/profile/json?player=${encodeURIComponent(playerName)}`;

    const article = document.getElementById("player-article");
    const notFound = document.getElementById("player-not-found");

    try {
        const response = await fetch(apiURL);
        const data = await response.json();
        
        if (!data.name || data.error) {
            throw new Error("Jugador no encontrado");
        }

        document.getElementById("player-name").textContent = data.name;
        document.getElementById("player-clan").textContent = `Clan: ${data.clan || "Sin clan"}`;
        document.getElementById("player-points").textContent = `Puntuación: ${data.points}`;

        article.style.display = "flex";
        notFound.style.display = "none";

        console.log("Datos del jugador:", data);
    } catch (error) {
        console.error(error);
        article.style.display = "none";
        notFound.style.display = "block";
    }
});
document.addEventListener("DOMContentLoaded", async () => {
    const params = new URLSearchParams(window.location.search);
    const playerName = params.get("player_name");

    const apiURL = `https://ddstats.tw/profile/json?player=${encodeURIComponent(playerName)}`;

    try {
        const response = await fetch(apiURL);
        const data = await response.json();
        if(data.error) {
            throw new Error(`No se ha encontrado un jugador con el nombre ${playerName}`);
        }

        document.getElementById("player-name").textContent = data.name;
        document.getElementById("player-clan").textContent = `Clan: ${data.clan || "Sin clan"}`;
        document.getElementById("player-points").textContent = `Puntuación: ${data.points}`;

        console.log("Datos del jugador:", data);
    } catch (error) {
        console.error(error);
    }
});
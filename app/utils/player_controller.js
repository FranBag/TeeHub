async function loadCountryFlagsMap() {
    const response = await fetch("../utils/countryflags.json");
    return await response.json();
}

function getFlagUrl(code, map) {
    if (code == null || code < 0) return null;
    const filename = map[code];
    if (!filename) return null;

    return `https://raw.githubusercontent.com/ddnet/ddnet/master/data/countryflags/${filename}`;
}

document.addEventListener("DOMContentLoaded", async () => {
    const map = await loadCountryFlagsMap();
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

        const skinUrl = `https://teedata.net/api/skin/render/name/${encodeURIComponent(data.skin_name)}`;

        const imgSkin = document.getElementById("player-skin");
        imgSkin.src = skinUrl;
        imgSkin.onerror = () => {
            imgSkin.src = "../../public/assets/images/player_skin_placeholder.png";
        };

        const imgFlag = document.getElementById("player-countryflag");

        const flagUrl = getFlagUrl(data.country, map);  

        if (flagUrl) {
            imgFlag.src = flagUrl;
            imgFlag.style.display = "block";
        } else {
            imgFlag.src = "../../public/assets/images/country_flag_placeholder.png";
        }
        console.log(data);

        article.style.display = "flex";
        notFound.style.display = "none";
    } catch (error) {
        console.error(error);
        article.style.display = "none";
        notFound.style.display = "block";
    }
});
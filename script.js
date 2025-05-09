document.addEventListener('DOMContentLoaded', () => {
    const characterForm = document.getElementById('character-form');
    const combatForm = document.getElementById('combat-form');
    const refreshStatsButton = document.getElementById('refresh-stats');
    const statsOutput = document.getElementById('stats-output');
    const characterList = document.getElementById('character-list');

    characterForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(characterForm);
        formData.append('action', 'create');

        const response = await fetch('src/index.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();
        alert(result);
        refreshCharacterList();
    });

    combatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(combatForm);

        const response = await fetch('src/index.php?action=simulate', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();
        alert(result);
    });

    refreshStatsButton.addEventListener('click', async () => {
        const response = await fetch('src/index.php?action=stats');
        const result = await response.text();
        statsOutput.textContent = result;
    });

    async function refreshCharacterList() {
        const response = await fetch('src/index.php?action=stats');
        const characters = await response.json();

        characterList.innerHTML = '';
        characters.forEach(character => {
            const card = document.createElement('div');
            card.className = 'character-card';
            card.innerHTML = `
                <h3>${character.nom}</h3>
                <p>Force: ${character.force}</p>
                <p>Localisation: ${character.localisation}</p>
                <p>Niveau: ${character.niveau}</p>
                <p>HP: ${character.hp}</p>
            `;
            characterList.appendChild(card);
        });
    }

    refreshCharacterList();
});
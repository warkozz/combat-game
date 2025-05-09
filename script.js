document.addEventListener('DOMContentLoaded', () => {
    const characterForm = document.getElementById('character-form');
    const characterList = document.getElementById('character-list');
    const editPopup = document.getElementById('edit-popup');
    const editForm = document.getElementById('edit-form');
    const closePopupButton = document.getElementById('close-popup');

    characterForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(characterForm);
        formData.append('action', 'create');

        try {
            const response = await fetch('src/index.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            alert(result.message);
            refreshCharacterList();
        } catch (error) {
            console.error('Erreur lors de la création du personnage :', error);
        }
    });

    async function refreshCharacterList() {
        try {
            const response = await fetch('src/index.php?action=stats');

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text(); // Log the raw response for debugging
                console.error('Réponse brute du serveur :', text);
                throw new Error('La réponse du serveur n\'est pas au format JSON.');
            }

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
                    <div class="card-buttons">
                        <button class="delete-btn" data-id="${character.id}">Supprimer</button>
                        <button class="edit-btn" data-id="${character.id}">Modifier</button>
                    </div>
                `;
                characterList.appendChild(card);
            });

            attachDeleteEvents();
            attachEditEvents(characters);
        } catch (error) {
            console.error('Erreur lors du rafraîchissement de la liste des personnages :', error);
            alert('Une erreur est survenue lors du chargement des personnages. Veuillez réessayer.');
        }
    }

    function attachDeleteEvents() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', async (e) => {
                const id = e.target.dataset.id;
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);

                try {
                    const response = await fetch('src/index.php', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    alert(result.message);
                    refreshCharacterList();
                } catch (error) {
                    console.error('Erreur lors de la suppression du personnage :', error);
                }
            });
        });
    }

    function attachEditEvents(characters) {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const id = e.target.dataset.id;
                const character = characters.find(c => c.id == id);
                if (character) {
                    editForm.dataset.editId = id;
                    document.getElementById('edit-nom').value = character.nom;
                    document.getElementById('edit-force').value = character.force;
                    document.getElementById('edit-localisation').value = character.localisation;
                    document.getElementById('edit-niveau').value = character.niveau;
                    document.getElementById('edit-hp').value = character.hp;
                    editPopup.classList.remove('hidden');
                } else {
                    console.error('Personnage non trouvé pour l\'ID :', id);
                }
            });
        });
    }

    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = editForm.dataset.editId;
        const formData = new FormData(editForm);
        formData.append('action', 'update');
        formData.append('id', id);

        try {
            const response = await fetch('src/index.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            alert(result.message);
            editPopup.classList.add('hidden');
            refreshCharacterList();
        } catch (error) {
            console.error('Erreur lors de la mise à jour du personnage :', error);
        }
    });

    closePopupButton.addEventListener('click', () => {
        editPopup.classList.add('hidden');
    });

    refreshCharacterList();
});
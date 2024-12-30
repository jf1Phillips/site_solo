function loadFile(file, id) {
    fetch(file).then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors du chargement du fichier');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById(id).innerText = data;
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
}

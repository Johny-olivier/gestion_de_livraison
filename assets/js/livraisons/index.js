// Récupération des éléments
const searchInput = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');
const sortBy = document.getElementById('sortBy');
const tableBody = document.querySelector('#livraisonsTable tbody');

// Fonction principale pour filtrer et trier
function filterAndSort() {
    const searchTerm = searchInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const sortValue = sortBy.value;

    let rows = Array.from(tableBody.querySelectorAll('.livraison-row'));

    // --- Filtrage ---
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const badge = row.querySelector('.badge-statut');
        const rowStatus = badge ? badge.dataset.statut.toLowerCase() : '';

        const matchesSearch = text.includes(searchTerm);
        const matchesStatus = !status || rowStatus === status;

        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });

    // --- Tri ---
    rows = rows.filter(r => r.style.display !== 'none'); // uniquement les lignes visibles

    rows.sort((a, b) => {
        let aVal, bVal;

        switch (sortValue) {
            case 'id_asc':
                aVal = parseInt(a.querySelector('td:first-child').textContent.replace('#',''));
                bVal = parseInt(b.querySelector('td:first-child').textContent.replace('#',''));
                return aVal - bVal;
            case 'id_desc':
                aVal = parseInt(a.querySelector('td:first-child').textContent.replace('#',''));
                bVal = parseInt(b.querySelector('td:first-child').textContent.replace('#',''));
                return bVal - aVal;
            case 'date_asc':
                aVal = new Date(a.querySelector('td:nth-child(8) span').textContent.split('/').reverse().join('-'));
                bVal = new Date(b.querySelector('td:nth-child(8) span').textContent.split('/').reverse().join('-'));
                return aVal - bVal;
            case 'date_desc':
                aVal = new Date(a.querySelector('td:nth-child(8) span').textContent.split('/').reverse().join('-'));
                bVal = new Date(b.querySelector('td:nth-child(8) span').textContent.split('/').reverse().join('-'));
                return bVal - aVal;
            default:
                return 0;
        }
    });

    // Réinjecter les lignes triées
    rows.forEach(r => tableBody.appendChild(r));
}

// --- Événements ---
searchInput.addEventListener('keyup', filterAndSort);
statusFilter.addEventListener('change', filterAndSort);
sortBy.addEventListener('change', filterAndSort);

// --- Réinitialisation ---
function resetFilters() {
    searchInput.value = '';
    statusFilter.value = '';
    sortBy.value = 'date_desc';
    filterAndSort();
}

// Lancer le filtre au chargement pour initialiser
filterAndSort();


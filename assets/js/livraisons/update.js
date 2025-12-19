// Validation du formulaire
document.getElementById('livraisonForm').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value) {
            isValid = false;
            field.style.borderColor = '#f5576c';
        } else {
            field.style.borderColor = '#e2e8f0';
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires (*)');
    }
});

// Animation des champs au focus
document.querySelectorAll('.form-control, .form-select').forEach(input => {
    input.addEventListener('focus', function() {
        this.style.transform = 'scale(1.01)';
        this.style.transition = 'all 0.2s ease';
    });

    input.addEventListener('blur', function() {
        this.style.transform = 'scale(1)';
    });
});

// Détection des modifications non sauvegardées
let formModified = false;
const form = document.getElementById('livraisonForm');
const formInputs = form.querySelectorAll('input, select, textarea');

formInputs.forEach(input => {
    input.addEventListener('change', () => {
        formModified = true;
    });
});

window.addEventListener('beforeunload', (e) => {
    if (formModified) {
        e.preventDefault();
        e.returnValue = '';
    }
});

form.addEventListener('submit', () => {
    formModified = false;
});
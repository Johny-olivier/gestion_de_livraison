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

// Définir la date minimale à aujourd'hui
const dateInput = document.getElementById('date_livraison');
const now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
dateInput.min = now.toISOString().slice(0, 16);
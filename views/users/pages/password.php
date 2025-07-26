<div class="tab-pane " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
    <div class="d-flex justify-content-center">
        <form id="form_change_password" method="post" action="" style="max-width: 400px; width: 100%;">
            <h5 class="text-center mb-4">Changer le mot de passe</h5>

            <!-- Mot de passe actuel -->
            <div class="form-group position-relative">
                <label for="current_password" class="font-weight-bold">Mot de passe actuel</label>
                <input type="password" placeholder="Entrez l'ancien mot de passe" name="current_password" id="current_password" class="form-control" required>
                <span class="toggle-password" toggle="#current_password"><i class="fa fa-eye position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></i></span>
            </div>

            <!-- Nouveau mot de passe -->
            <div class="form-group position-relative mt-3">
                <label for="new_password" class="font-weight-bold">Nouveau mot de passe</label>
                <input type="password" placeholder="Entrez le nouveau mot de passe" name="new_password" id="new_password" class="form-control" required>
                <span class="toggle-password" toggle="#new_password"><i class="fa fa-eye position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></i></span>
            </div>

            <!-- Confirmation -->
            <div class="form-group position-relative mt-3">
                <label for="confirm_password" class="font-weight-bold">Confirmer le mot de passe</label>
                <input type="password" placeholder="Confirmez le nouveau mot de passe" name="confirm_password" id="confirm_password" class="form-control" required>
                <span class="toggle-password" toggle="#confirm_password"><i class="fa fa-eye position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></i></span>
            </div>

            <!-- Message d'erreur -->
            <div id="password-error" class="text-danger text-center mt-2" style="display: none;">
                Les mots de passe ne correspondent pas.
            </div>
            <input type="hidden" name="id" value="<?= USER_ID ?? '' ?>">
            <!-- Boutons -->
            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn btn-primary text-white mb-2">
                    <i class="fa fa-save"></i> Modifier
                </button>
                <a href="javascript:history.back()" class="btn btn-outline-secondary mr-2">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript de validation et affichage mot de passe -->
<script>
document.getElementById('form_change_password').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const errorDiv = document.getElementById('password-error');

    if (newPassword !== confirmPassword) {
        e.preventDefault(); // Empêche l'envoi
        errorDiv.style.display = 'block';
    } else {
        errorDiv.style.display = 'none';
    }
});

// Icône œil pour afficher/masquer
document.querySelectorAll('.toggle-password').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
        const input = document.querySelector(this.getAttribute('toggle'));
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});
</script>

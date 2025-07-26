const LINK = window.location.origin + '/admin_app/public/';
// const LINK = window.location.origin + '/burostore/public/';
const LINKS = window.location.origin + '/'; // En local il faut ajouter tontine/ pour que çà passe!

function trRemove(selecter) {
  $(selecter).remove();

}

function go_b() {
  history.back();
}

function showAlert(title, message, icon = 'success') {
  Swal.fire({
    title: `<span style="font-size: 24px;">${title}</span>`,
    html: `<span style="font-size: 18px;">${message}</span>`,
    icon: icon,
    confirmButtonText: '<span style="font-size: 16px;">OK</span>'
  }).then((result) => {
    if (result.isConfirmed) {
      // Recharge la page
      location.reload();
    }
  });
}


// $(document).ajaxStart(function() { Pace.restart(); });
function connexion() {
  $('.formConnexion').on('submit', function (e) {
    e.preventDefault(); // Empêche la soumission normale du formulaire
    // Vérifie si le formulaire est valide

    $.ajax({
      url: LINK + 'authController/connexion',
      type: 'POST',
      data: $(this).serialize(),
      beforeSend: function () {
        loading('.btnConnexion', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
      },
      success: function (rep) {
        // console.log(rep);return;
        let response = JSON.parse(rep);
        loading('.btnConnexion', false, '<button type="submit" class="btn btnConnexion py-0">Se connecter <i class="fa fa-sign-in"></i></button>'); // desactiver loader
        // Simule une connexion réussie (remplace cela par ta logique backend)

        if (response.status == 1) {
          showAlert('Connexion réussie !', response.msg, 'success');
          window.location.href = LINK + 'home';
        } else {
          console.log(response);

          showAlert('Désolé !', response, 'error');
        }
      },
      error: function (xhr, status, error) {
        alert('Erreur : ' + error);
      }
    });

  });
}

function togglePassword() {
  var passwordField = document.getElementById("password");
  var toggleIcon = document.getElementById("togglePasswordIcon");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}
// Fonction pour détecter le réseau et afficher le logo

function verifForm(fields) {
  // Ajout des écouteurs d'événements
  fields.forEach(field => {
    const input = document.getElementById(field.id);

    // Écoute les changements même pour TinyMCE
    if (tinymce.get(field.id)) {
      tinymce.get(field.id).on('input', function () {
        validateField(input, field.regex, field.errorMessage);
      });
    } else {
      input.addEventListener('input', function () {
        validateField(input, field.regex, field.errorMessage);
      });
    }
  });

  // Fonction principale pour valider tous les champs
  function validateForm() {
    let isValid = true;

    fields.forEach(field => {
      const input = document.getElementById(field.id);
      if (!validateField(input, field.regex, field.errorMessage)) {
        isValid = false;
      }
    });

    return isValid;
  }

  // Fonction pour valider un seul champ
  function validateField(input, regex, errorMessage) {
    const id = input.id;
    const isTinyMCE = tinymce.get(id) !== null;

    // Obtenir la vraie valeur à valider
    let value = isTinyMCE
      ? tinymce.get(id).getContent({ format: 'text' }).trim()
      : input.value.trim();

    const errorElement = document.getElementById(id + 'Error');
    const nextSibling = input.nextElementSibling;
    const iconElement = nextSibling ? nextSibling.querySelector('i') : null;

    if (!regex.test(value)) {
      input.classList.add('invalid');
      input.classList.remove('valid');

      if (errorElement) {
        errorElement.innerHTML = `<i class="fa fa-exclamation-circle mr-2"></i> ${errorMessage}`;
        errorElement.classList.add('text-red-500');
      }

      if (iconElement) {
        iconElement.classList.add('text-red-500');
        iconElement.classList.remove('text-green-500');
      }

      return false;
    } else {
      input.classList.add('valid');
      input.classList.remove('invalid');

      if (errorElement) {
        errorElement.innerHTML = '';
        errorElement.classList.remove('text-red-500');
      }

      if (iconElement) {
        iconElement.classList.remove('text-red-500');
        iconElement.classList.add('text-green-500');
      }

      return true;
    }
  }

  return validateForm;
}


function tableField(includeFields) {
  const allFields = {
    nom: { id: 'nom', regex: /.+/, errorMessage: 'Le nom est requis.' },
    nom_user: { id: 'nom_user', regex: /.+/, errorMessage: 'Le nom est requis.' },
    prenom_user: { id: 'prenom_user', regex: /.+/, errorMessage: 'Le nom est requis.' },
    tel: { id: 'tel', regex: /^(07|05|01)\d{8}$/, errorMessage: 'Veuillez entrer un numéro de téléphone valide qui commence par 07, 05, ou 01, suivi de 8 chiffres.' },
    // Mot de passe (vérifie que le mot de passe est égal à "PRO-01" ou qu'il est présent)
    password: { id: 'password', regex: /^(ADMIN-01)$/, errorMessage: 'Le mot de passe est incorrect.' },
    password_agent: { id: 'password_agent', regex: /^(AGENT-01)$/, errorMessage: 'Le mot de passe est incorrect.' },
    poste: { id: 'poste', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner un poste valide.' },
    role: { id: 'role', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner un role valide.' },
    metier: { id: 'metier', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner un metier valide.' },
    email: { id: 'email', regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, errorMessage: 'Veuillez entrer un email valide.' },
    email_user: { id: 'email_user', regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, errorMessage: 'Veuillez entrer un email valide.' },
    libelle: { id: 'libelle', regex: /.+/, errorMessage: 'Le libelle est requis.' },
    lieu: { id: 'lieu', regex: /.+/, errorMessage: 'Le lieu est requis.' },
    domicile: { id: 'domicile', regex: /.+/, errorMessage: 'Le domicile est requis.' },
    date: { id: 'date', regex: /^\d{4}-\d{2}-\d{2}$/, errorMessage: 'Veuillez saisir une date valide (YYYY-MM-DD).' },
    photo: { id: 'photo', regex: /.+/, errorMessage: 'Veuillez télécharger la photo (formats acceptés : .jpg, .png).' },
    lieu_activite: { id: 'lieu_activite', regex: /.+/, errorMessage: 'Le lieu activite est requis.' },
    // metier: { id: 'metier', regex: /.+/, errorMessage: 'Le  metier est requis.' },
    // ['nom','prenom', 'date','lieu','photo','lieu_activite','domicile', "metier"];

    // Pièce d'identité (vérifie si un fichier a été sélectionné et accepte les types .jpg, .png, .pdf)
    piece_pro: { id: 'piece_pro', regex: /^[A-Z0-9]{8,15}$/, errorMessage: 'Veuillez entrer un numéro de pièce valide (CNI ou Passeport : 8 à 15 caractères, lettres et chiffres).' },

    // Photo recto (vérifie si un fichier a été sélectionné et accepte les types .jpg, .png)
    photo_recto_pro: { id: 'photo_recto_pro', regex: /.+/, errorMessage: 'Veuillez télécharger la photo recto (formats acceptés : .jpg, .png).' },

    // Photo verso (vérifie si un fichier a été sélectionné et accepte les types .jpg, .png)

    libelle_famille: { id: "libelle_famille", regex: /^[a-zA-Z0-9\s\-]{3,100}$/, errorMessage: "Veuillez entrer un libellé valide (3 à 100 caractères)." },
    libelle_categorie: { id: "libelle_categorie", regex: /^[a-zA-Z0-9\s\-]{3,100}$/, errorMessage: "Veuillez entrer un libellé valide (3 à 100 caractères)." },
    libelle_produit: { id: "libelle_produit", regex: /^[a-zA-Z0-9\s\-]{3,100}$/, errorMessage: "Veuillez entrer un libellé valide (3 à 100 caractères)." },
    qte_produit: { id: 'qte_produit', regex: /^[1-9]\d*$/, errorMessage: 'Saisissez un nombre entier positif supérieur à 0.' },
    prix_produit: { id: 'prix_produit', regex: /^[1-9]\d*$/, errorMessage: 'Saisissez un nombre entier positif supérieur à 0.' },
    description_produit: { id: 'description_produit', regex: /.+/, errorMessage: 'Le description appartement est requis.' },
    categorie_id: { id: 'categorie_id', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner une categorie valide.' },
    id_livreur: { id: 'id_livreur', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner une categorie valide.' },
    id_action: { id: 'id_action', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner une categorie valide.' },
    telephone: { id: 'telephone', regex: /^(07|05|01)\d{8}$/, errorMessage: 'Veuillez entrer un numéro de téléphone valide qui commence par 07, 05, ou 01, suivi de 8 chiffres.' },
    telephone_user: { id: 'telephone_user', regex: /^(07|05|01)\d{8}$/, errorMessage: 'Veuillez entrer un numéro de téléphone valide qui commence par 07, 05, ou 01, suivi de 8 chiffres.' },
    telephoneModif: { id: 'telephoneModif', regex: /^(07|05|01)\d{8}$/, errorMessage: 'Veuillez entrer un numéro de téléphone valide qui commence par 07, 05, ou 01, suivi de 8 chiffres.' },
    full_name: { id: 'full_name', regex: /.+/, errorMessage: 'Le nom et prenom est requis.' },
    full_nameModif: { id: 'full_nameModif', regex: /.+/, errorMessage: 'Le nom et prenom est requis.' },
    titre: { id: 'titre', regex: /.+/, errorMessage: 'Le titre est requis.' },
    extrait: { id: 'extrait', regex: /.+/, errorMessage: 'L\'extrait est requis.' },
    contenu: { id: 'contenu', regex: /.+/, errorMessage: 'Le contenu est requis.' },
    titreEdit: { id: 'titreEdit', regex: /.+/, errorMessage: 'Le titre est requis.' },
    extraitEdit: { id: 'extraitEdit', regex: /.+/, errorMessage: 'L\'extrait est requis.' },
    contenuEdit: { id: 'contenuEdit', regex: /.+/, errorMessage: 'Le contenu est requis.' },
    image: { id: 'image', regex: /.+/, errorMessage: 'Veuillez télécharger l\'image (formats acceptés : .jpg, .png).' },
    motif: { id: 'motif', regex: /.+/, errorMessage: 'Le situation appartement est requis.' },

    prix_forfait: { id: "prix_forfait", regex: /^[1-9]\d{3,6}$/, errorMessage: "Veuillez entrer un prix valide (minimum 1000)." },
    avantage: { id: "avantage", regex: /^[1-9]\d{0,2}$/, errorMessage: "Veuillez entrer un avantage valide (entre 1 et 999)." },
    nom_locataire: { id: 'nom_locataire', regex: /.+/, errorMessage: 'Le nom est requis.' },
    tel_locataire: { id: 'tel_locataire', regex: /^(07|05|01)\d{8}$/, errorMessage: 'Veuillez entrer un numéro de téléphone valide qui commence par 07, 05, ou 01, suivi de 8 chiffres.' },
    profession_locataire: { id: 'profession_locataire', regex: /.+/, errorMessage: 'La profession est requis.' },

    password_locataire: { id: 'password_locataire', regex: /^(LOC-01)$/, errorMessage: 'Le mot de passe est incorrect.' },
    jour: { id: 'jour', regex: /^[1-9]\d*$/, errorMessage: 'Saisissez un nombre entier positif supérieur à 0.' },
    id_famille: { id: 'id_famille', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner une appartement valide.' },
    caution_location: { id: 'caution_location', regex: /^[1-9]\d*$/, errorMessage: 'Saisissez un nombre entier positif supérieur à 0.' },
    avance_location: { id: 'avance_location', regex: /^[1-9]\d*$/, errorMessage: 'Saisissez un nombre entier positif supérieur à 0.' },
    // Ajout des conditions pour les dates
    date_fin: { id: 'date_fin', regex: /^\d{4}-\d{2}-\d{2}$/, errorMessage: 'Veuillez saisir une date valide (YYYY-MM-DD).' },
    type_id: { id: 'type_id', regex: /^(?!default$).+$/, errorMessage: 'Veuillez sélectionner un type valide.' },
    prix_appart: { id: "prix_appart", regex: /^[1-9]\d{3,6}$/, errorMessage: "Veuillez entrer un prix valide (minimum 1000)." },
    situation_appart: { id: 'situation_appart', regex: /.+/, errorMessage: 'Le situation appartement est requis.' },

  };

  return includeFields.map(field => allFields[field]);  // Retourne uniquement les champs spécifiés dans includeFields
}

function formIsValided(table) {
  tinymce.triggerSave(); // Synchronise les contenus TinyMCE avec les textarea

  const fields = tableField(table); // Exemple d'utilisation de la fonction tableField
  const formIsValidTable = verifForm(fields); // Fonction de validation des champs

  return formIsValidTable();
}


function loading(selector, status, message) {
  $(selector).html(message);
  $(selector).attr('disabled', status);
}


function addLivreur() // form
{
  $('.form_add_livreur').on('submit', function (e) {
    e.preventDefault();

    const table = ['full_name', 'telephone'];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      $.ajax({
        url: LINK + 'livreurController/add',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>'); // desactiver loader
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          } else {
            showAlert('Désolé !', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur :' + error);
        }
      });
    }
  });
}


function addImages() {
  $('.form_add_image').on('submit', function (e) {
    e.preventDefault();

    const imageInput = $(this).find('input[name="images[]"]')[0]; // plusieurs fichiers
    const files = imageInput.files;

    if (!files || files.length === 0) {
      showAlert('Attention !', 'Veuillez sélectionner au moins une image.', 'warning');
      return;
    }

    // Créer un FormData contenant toutes les images et les autres données du formulaire
    let formData = new FormData(this); // inclut produit_id automatiquement

    // Envoie AJAX
    $.ajax({
      url: LINK + 'imageController/addImage', // côté serveur : traite plusieurs fichiers
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>');
      },
      success: function (rep) {
        let response = JSON.parse(rep);

        loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>');

        if (response.status == 1) {
          showAlert('Félicitations !', response.msg, 'success');
          setTimeout(() => {
            location.reload();
          }, 2000);
        } else {
          showAlert('Désolé !', response.msg, 'error');
        }
      },
      error: function (xhr, status, error) {
        alert('Erreur : ' + error);
      }
    });
  });
}


function addLivraison() {
  $('.form_add_Livraison').on('submit', function (e) {
    e.preventDefault();

    const table = ['id_livreur'];

    if (formIsValided(table)) {
      let formData = $(this).serialize();

      $.ajax({
        url: LINK + 'livraisonController/add',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>');
        },
        success: function (rep) {
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>');

          if (response.status == 1) {
            Swal.fire({
              icon: 'success',
              title: 'Livraison enregistrée !',
              text: response.msg,
              timer: 1500,
              showConfirmButton: false
            }).then(() => {
              // ➤ Lancer AJAX vers génération du PDF
              $.ajax({
                url: LINK + 'impression/bon_livraison',
                type: 'GET',
                data: { id: response.id_livraison },
                xhrFields: { responseType: 'blob' },
                success: function (data) {
                  // console.log(data); return; // ← ça te dira si c’est un PDF ou du texte d’erreur
                  const blob = new Blob([data], { type: 'application/pdf' });
                  const url = URL.createObjectURL(blob);
                  window.open(url, '_blank');

                  // ➤ Ensuite, recharger la page
                  setTimeout(() => location.reload(), 2000);
                },
                error: function () {
                  Swal.fire('Erreur', 'Échec lors de la génération du bon de livraison.', 'error');
                }
              });
            });

          } else {
            Swal.fire('Erreur', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur AJAX : ' + error);
        }
      });
    }
  });
}


function editLivreur() // form
{
  $('.form_edit_Livreur').on('submit', function (e) {
    e.preventDefault();

    const table = ['full_nameModif', 'telephoneModif'];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      $.ajax({
        url: LINK + 'livreurController/edit',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>'); // desactiver loader
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          } else {
            showAlert('Désolé !', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur :' + error);
        }
      });
    }
  });
}

function editUsers() // form
{
  $('#form_edit_user').on('submit', function (e) {
    e.preventDefault();

    const table = ['nom_user', 'prenom_user', 'telephone_user', 'email_user'];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      console.log(formData);
      
      $.ajax({
        url: LINK + 'usersController/edit',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>'); // desactiver loader
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          } else {
            showAlert('Désolé !', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur :' + error);
        }
      });
    }
  });
}

function modifPassword() // form
{
  $('#form_change_password').on('submit', function (e) {
    e.preventDefault();

    // const table = ['nom_user', 'prenom_user', 'telephone_user', 'email_user'];

    // Vérifie si le formulaire est valide
    // if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      console.log(formData);
      
      $.ajax({
        url: LINK + 'usersController/editPassword',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>'); // desactiver loader
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          } else {
            showAlert('Désolé !', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur :' + error);
        }
      });
    // }
  });
}


function countNewElement(select, endPoint,selectDot) // form
{
  $.ajax({
    url: LINK + endPoint,
    type: 'GET',
    success: function (rep) {
      // console.log(rep);return
      let response = JSON.parse(rep);
      if (response.status == 1) {
        $(select).text(response.count);
        $(select).removeClass('hidden');
        $(selectDot).removeClass('hidden');
      }
    },
    error: function (xhr, status, error) {
      alert('Erreur :' + error);
    }
  });
}


function checkLivraison() {
  $('.form_check_Livraison').on('submit', function (e) {
    e.preventDefault();
    var action = $('#id_action').val();
    const table = ['id_action'];
    if (action == 2) {
      const table = ['id_action', 'motif'];
    }

    if (formIsValided(table)) {
      let formData = $(this).serialize();
      console.log(formData);

      $.ajax({
        url: LINK + 'livraisonController/check',
        type: 'POST',
        data: formData,
        beforeSend: function () {
          loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>');
        },
        success: function (rep) {
          //   console.log(rep);return;
          let response = JSON.parse(rep);

          loading('.btn_actions', false, '<button type="submit" class="btn btn-primary py-0 btn_action">Sauvegarder</button>');
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          } else {
            showAlert('Désolé !', response.msg, 'error');
          }
        },
        error: function (xhr, status, error) {
          alert('Erreur AJAX : ' + error);
        }
      });
    }
  });
}


function changeById(id) {
  event.preventDefault(); // Empêche le rechargement si le bouton est dans un <form>

  Swal.fire({
    title: `<span style="font-size: 24px;">Attention!</span>`,
    html: `<span style="font-size: 18px;">Voulez-vous vraiment effectuer cette opération ?</span>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: '<span style="font-size: 16px;">Accepter</span>',
    cancelButtonText: '<span style="font-size: 16px;">Annuler</span>',
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        method: "POST",
        url: LINK + "adminController/changer",
        data: { id_admin: id, btn_changer: 1 },  // Envoi de l'ID au serveur
        success: function (rep) {
          let data = rep.split('#');
          if (data[0] == 1) {
            showAlert('Félicitations !', 'Enregistrement effectué avec succès.', 'success');
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire

            }, 2000)
          }
        },
        error: function (xhr, status, error) {
          showAlert('Désolé !', response, 'error');
        }
      });
    }
  });
}

function changeDeleteById(url, id) {
  event.preventDefault(); // Empêche le rechargement si le bouton est dans un <form>

  Swal.fire({
    title: `<span style="font-size: 24px;">Attention!</span>`,
    html: `<span style="font-size: 18px;">Voulez-vous vraiment effectuer cette opération ?</span>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: '<span style="font-size: 16px;">Accepter</span>',
    cancelButtonText: '<span style="font-size: 16px;">Annuler</span>',
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        method: "POST",
        url: LINK + url,
        data: { id: id, btn_changer: 1 },  // Envoi de l'ID au serveur
        success: function (rep) {
          // console.log(rep);return;

          let response = JSON.parse(rep);
          if (response.status == 1) {
            showAlert('Félicitations !', response.msg, 'success');
            trRemove('#trRemove-' + id);
            if (response.reload == 1) {
              setInterval(() => {
                location.reload(); // Actualise la page si nécessaire

              }, 2000)
            }

          }
        },
        error: function (xhr, status, error) {
          showAlert('Désolé !', response, 'error');
        }
      });
    }
  });
}

function animateCounters() {
  const counters = document.querySelectorAll(".stat-box");

  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute("data-target").replace(/\s/g, ''), 10); // Supprime les espaces pour les nombres formatés
    let current = 0;
    const increment = target / 100; // Ajuste la vitesse

    function updateCounter() {
      current += increment;
      if (current < target) {
        counter.textContent = Math.ceil(current);
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target.toLocaleString('fr-FR'); // Format français (ex: 1 000)
      }
    }

    updateCounter();
  });
}

function ajaxRequest(url, data, method) {
  $.ajax({
    method: method,
    url: url,
    data: data,
    success: function (rep) {
      // console.log(rep);return;
      let response = JSON.parse(rep);
      var printWindow = window.open(response.lien, "_blank");


      setTimeout(function () {
        //var printWindow = window.open(response.lien); 
        if (printWindow) {
          printWindow.focus(); // Assure que la fenêtre est active
          printWindow.print(); // Lance l'impression
        }
      }, 5000); // Ajustez le délai si nécessaire
    },

  });
}

function dataURLtoBlob(dataURL) {
  const arr = dataURL.split(',');
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);

  while (n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }

  return new Blob([u8arr], { type: mime });
}

function createPagination(containerSelector, itemSelector, itemsPerPage = 6) {
  const items = document.querySelectorAll(itemSelector);
  const pagination = document.querySelector(containerSelector);
  const totalPages = Math.ceil(items.length / itemsPerPage);
  let currentPage = 1;

  function showPage(page) {
    currentPage = page;
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    items.forEach((item, index) => {
      item.style.display = (index >= start && index < end) ? 'block' : 'none';
    });

    // Met à jour les classes actives
    const pageItems = pagination.querySelectorAll('.page-item');
    pageItems.forEach(el => el.classList.remove('active'));
    const activeBtn = pagination.querySelector(`.page-link[data-page="${page}"]`);
    if (activeBtn) activeBtn.parentElement.classList.add('active');

    // Activer/désactiver les boutons prev/next
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    if (prevBtn && nextBtn) {
      prevBtn.classList.toggle('disabled', page === 1);
      nextBtn.classList.toggle('disabled', page === totalPages);
    }
  }

  function setupPagination() {
    pagination.innerHTML = '';

    // Bouton précédent
    const prevLi = document.createElement('li');
    prevLi.className = 'page-item';
    prevLi.id = 'prevBtn';
    const prevA = document.createElement('a');
    prevA.className = 'page-link';
    prevA.href = '#';
    prevA.innerHTML = '&laquo;';
    prevA.addEventListener('click', e => {
      e.preventDefault();
      if (currentPage > 1) showPage(currentPage - 1);
    });
    prevLi.appendChild(prevA);
    pagination.appendChild(prevLi);

    // Pages numérotées
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.className = 'page-item' + (i === 1 ? ' active' : '');
      const a = document.createElement('a');
      a.className = 'page-link';
      a.href = '#';
      a.textContent = i;
      a.setAttribute('data-page', i);
      a.addEventListener('click', function (e) {
        e.preventDefault();
        showPage(i);
      });
      li.appendChild(a);
      pagination.appendChild(li);
    }

    // Bouton suivant
    const nextLi = document.createElement('li');
    nextLi.className = 'page-item';
    nextLi.id = 'nextBtn';
    const nextA = document.createElement('a');
    nextA.className = 'page-link';
    nextA.href = '#';
    nextA.innerHTML = '&raquo;';
    nextA.addEventListener('click', e => {
      e.preventDefault();
      if (currentPage < totalPages) showPage(currentPage + 1);
    });
    nextLi.appendChild(nextA);
    pagination.appendChild(nextLi);
  }

  // Initialisation
  if (items.length > 0) {
    setupPagination();
    showPage(1);
  }
}

function formVersement() // form artisant edit
{
  $('.formVersement').on('submit', function (e) {
    e.preventDefault();
    // let modeVersement = $(this).data('mode');
    let data = $(this).serialize();
    // Créer un objet FormData pour gérer l'upload de fichiers
    $.ajax({
      url: LINK + 'rapportController/addVersement',
      type: 'POST',
      data: data,
      beforeSend: function () {
        loading('.btn_actions', 'disabled', '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'); // activer loader
      },
      success: function (rep) {
        // console.log(rep);return;
        let response = JSON.parse(rep);

        loading('.btn_actions', false, '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'); // desactiver loader
        if (response.status == 1) {
          // window.open(response.msg);
          showAlert('Félicitations !', response.msg, 'success');

          setInterval(() => {
            location.reload(); // Actualise la page si nécessaire

          }, 2000)
        } else {
          showAlert('Désolé !', response, 'error');
        }
      },
      error: function (xhr, status, error) {
        alert('Erreur :' + error);
      }
    });
  });
}

function ajaxRequest(url, data, method) {
  console.log('je suis dans ajax request');
  $.ajax({
    method: method,
    url: url,
    data: data,
    success: function (rep) {
      // console.log(rep);return;
      let response = JSON.parse(rep);
      var printWindow = window.open(response.lien, "_blank");

      showAlert('Félicitations !', 'Enregistrement effectué avec succes!', 'success');

      window.location.href = LINK + 'artisant/new_agent';

      setTimeout(function () {
        //var printWindow = window.open(response.lien); 
        if (printWindow) {
          printWindow.focus(); // Assure que la fenêtre est active
          printWindow.print(); // Lance l'impression
        }
      }, 5000); // Ajustez le délai si nécessaire
    },

  });
}



// Modification de la fonction existante
function updateLabel(input, labelId) {
  const fileLabel = document.getElementById(labelId);
  const preview = document.getElementById('preview_photo');
  const previewFinal = document.getElementById('preview_final_photo');
  const btnReprendre = document.getElementById('btnReprendre');
  const inputContainer = document.getElementById('photoInputContainer');

  if (fileLabel) {
    const file = input.files[0];

    if (file) {
      fileLabel.textContent = file.name;

      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        previewFinal.src = e.target.result;
        previewFinal.style.display = 'block';
        btnReprendre.style.display = 'inline-block';
        inputContainer.style.display = 'none';
        let base64Image = preview.src;
        console.log(preview.src)
        ajaxRemoveBgRequest(LINK + 'artisantController/removeGbImage', base64Image);
      };
      reader.readAsDataURL(file);
    } else {
      resetPhotoView();
    }
  }
}

// convert base46 to file

function resizeAndInjectBase64(base64Image, inputSelector, maxWidth = 800, maxHeight = 800, quality = 0.9) {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.src = base64Image;
    img.onload = () => {
      let width = img.width;
      let height = img.height;

      // Redimensionnement si nécessaire
      if (width > maxWidth || height > maxHeight) {
        const ratio = Math.min(maxWidth / width, maxHeight / height);
        width = Math.round(width * ratio);
        height = Math.round(height * ratio);
      }

      const canvas = document.createElement('canvas');
      canvas.width = width;
      canvas.height = height;

      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0, width, height);

      // compression en JPEG (tu peux mettre 'image/png' aussi)
      canvas.toBlob(blob => {
        if (!blob) return reject("Compression échouée");

        const file = new File([blob], "image_compressée.jpg", { type: blob.type });

        // injecter dans input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        const fileInput = document.querySelector(inputSelector);
        if (fileInput) {
          fileInput.files = dataTransfer.files;
          resolve(file);
        } else {
          reject("Input introuvable");
        }
      }, 'image/jpeg', quality); // qualité 0.0 à 1.0
    };

    img.onerror = err => reject("Erreur chargement image");
  });
}

function ajaxRemoveBgRequest(url, base64Image) {
  startFakeProgress();

  $.ajax({
    method: "POST",
    url: url,
    data: {
      image: base64Image,
      btn_to_remove_gb_image: true
    },
    success: function (rep) {
      //   let response = JSON.parse(rep);
      //   $('#preview_photo').attr('src', response.image).css('display', 'block');
      //   $('#preview_final_photo').attr('src', response.image).css('display', 'block');

      let response = JSON.parse(rep);
      const base64Data = response.image;

      $('#preview_photo').attr('src', base64Data).css('display', 'block');
      $('#preview_final_photo').attr('src', base64Data).css('display', 'block');

      resizeAndInjectBase64(base64Data, '#photo');


      completeProgress();
    }
  });
}


function addFamille() {
  // form famille add
  $(".form_add_famille").on("submit", function (e) {
    e.preventDefault();
    const table = ["libelle_famille"];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      console.log(formData);

      $.ajax({
        url: LINK + "familleController/add",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert("Félicitations !", response.msg, "success");
            // Clear the form
            $("#addOneFamilleModal").modal("hide");
            // setInterval(() => {
            //     window.location.href = LINK + 'admin/list';

            // }, 2000)
          } else {
            showAlert("Désolé !", response.msg, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

function editFamille() {
  // form ville edit
  $(".form_edit_famille").on("submit", function (e) {
    e.preventDefault();
    const table = ["libelle_famille"];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();

      $.ajax({
        url: LINK + "familleController/edit",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert(
              "Félicitations !",
              response.msg,
              "success"
            );
            // Clear the form
            $("#editVilleModal").modal("hide");
            // setInterval(() => {
            //     window.location.href = LINK + 'admin/list';

            // }, 2000)
          } else {
            showAlert("Désolé !", response.msg, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

function addCategorie() {
  // form famille add
  $(".form_add_categorie").on("submit", function (e) {
    e.preventDefault();
    const table = ["libelle_categorie", "id_famille"];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      console.log(formData);

      $.ajax({
        url: LINK + "categorieController/add",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          //   console.log(rep);return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert("Félicitations !", response.msg, "success");
            // Clear the form
            $("#addOneCategorieModal").modal("hide");
            // setInterval(() => {
            //     window.location.href = LINK + 'admin/list';

            // }, 2000)
          } else {
            showAlert("Désolé !", response.msg, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

function editCategorie() {
  // form Poste edit
  $(".form_edit_categorie").on("submit", function (e) {
    e.preventDefault();
    const table = ["libelle_categorie", "id_famille"];;

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      $.ajax({
        url: LINK + "categorieController/edit",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          // console.log(rep);return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert("Félicitations !", response.msg, "success");
            // Clear the form
            $("#editcategorieModal").modal("hide");
            // setInterval(() => {
            //     window.location.href = LINK + 'admin/list';

            // }, 2000)
          } else {
            showAlert("Désolé !", response.msg, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

function addProduit() {
  // form produit
  $(".formProduit").on("submit", function (e) {
    e.preventDefault();

    const table = ["libelle_produit", "qte_produit", "prix_produit", "description_produit", "categorie_id"];
    // let formData = $(this).serialize();
    // console.log(formData);
    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      // console.log(formData);

      $.ajax({
        url: LINK + "produitController/add",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          // console.log(response);
          // return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert(
              "Félicitations !",
              response.msg,
              "success"
            );
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire
            }, 2000);
          } else {
            showAlert("Désolé !", response, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

function addArticleBlog() {
  $(".form_add_article").on("submit", function (e) {
    e.preventDefault();

    const table = ["titre", "extrait", "contenu", "image"];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      const form = this;
      const imageInput = $(form).find('input[name="image"]')[0];
      const files = imageInput.files;

      if (!files || files.length === 0) {
        showAlert('Attention !', 'Veuillez sélectionner une image.', 'warning');
        return;
      }

      // Utilisation de FormData pour gérer les fichiers
      let formData = new FormData(form);

      $.ajax({
        url: LINK + "blogController/add",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          );
        },
        success: function (rep) {
          // console.log(rep);
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          );
          if (response.status == 1) {
            showAlert("Félicitations !", response.msg, "success");
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            showAlert("Désolé !", response.msg || "Une erreur est survenue.", "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur : " + error);
        },
      });
    }
  });
}

function editArticleBlog() {
  $(".form_edit_article").on("submit", function (e) {
    e.preventDefault();

    const table = ["titreEdit", "extraitEdit", "contenuEdit"];

    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      const form = this;
      const imageInput = $(form).find('input[name="image"]')[0];
      const files = imageInput.files;

      if (!files || files.length === 0) {
        showAlert('Attention !', 'Veuillez sélectionner une image.', 'warning');
        return;
      }

      // Utilisation de FormData pour gérer les fichiers
      let formData = new FormData(form);

      $.ajax({
        url: LINK + "blogController/edit",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          );
        },
        success: function (rep) {
          // console.log(rep);
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          );
          if (response.status == 1) {
            showAlert("Félicitations !", response.msg, "success");
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            showAlert("Désolé !", response.msg || "Une erreur est survenue.", "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur : " + error);
        },
      });
    }
  });
}

function editProduit() {
  // form produit
  $(".formEditProduit").on("submit", function (e) {
    e.preventDefault();

    const table = ["libelle_produit", "qte_produit", "prix_produit", "description_produit", "categorie_id"];
    // let formData = $(this).serialize();
    // console.log(formData);
    // Vérifie si le formulaire est valide
    if (formIsValided(table)) {
      // Créer un objet FormData pour gérer l'upload de fichiers
      let formData = $(this).serialize();
      // console.log(formData);

      $.ajax({
        url: LINK + "produitController/edit",
        type: "POST",
        data: formData,
        beforeSend: function () {
          loading(
            ".btn_actions",
            "disabled",
            '<i class="fa fa-spinner fa-spin fa-2x text-light"></i>'
          ); // activer loader
        },
        success: function (rep) {
          // console.log(response);
          // return;
          let response = JSON.parse(rep);
          loading(
            ".btn_actions",
            false,
            '<button type="submit" class="btn btn-primary btn_action">Sauvegarder</button>'
          ); // desactiver loader
          if (response.status == 1) {
            showAlert(
              "Félicitations !",
              response.msg,
              "success"
            );
            setInterval(() => {
              location.reload(); // Actualise la page si nécessaire
            }, 2000);
          } else {
            showAlert("Désolé !", response, "error");
          }
        },
        error: function (xhr, status, error) {
          alert("Erreur :" + error);
        },
      });
    }
  });
}

// Fonction réutilisable pour calculer la date de fin
function calculerDateFin(dateDebutSelector, nombreCautionSelector, dateFinSelector) {
  let dateDebut = $(dateDebutSelector).val(); // Récupérer la date de début
  let nombreCaution = $(nombreCautionSelector).val(); // Récupérer le nombre de mois de caution

  // Vérifier si la date de début et le nombre de mois sont valides
  if (dateDebut && nombreCaution) {
    let date = new Date(dateDebut); // Créer un objet Date avec la date de début

    // Ajouter le nombre de mois spécifié à la date de début
    date.setMonth(date.getMonth() + parseInt(nombreCaution)); // Ajouter des mois à la date de début

    // Formater la date de fin au format YYYY-MM-DD
    let dateFin = date.toISOString().split('T')[0];

    // Afficher la date de fin dans le champ
    $(dateFinSelector).val(dateFin);
  }
}



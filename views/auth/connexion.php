<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BURO STORE</title>
  <link rel="icon" href="<?=RACINE; ?>assets/logo/logobleu.jpg" type="image/jpeg">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
  <?php require_once 'inc/links/header.php'; ?>

  <style>
    body {
      /* background-color: #003b95; */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .logo {
      text-align: center;
      font-family: 'Orbitron', sans-serif;
      color: #003b95;
    }
    .logo .buro {
      font-size: 64px;
      font-weight: bold;
      letter-spacing: 8px;
      margin-bottom: 0px;
    }

    .logo .store {
      font-size: 48px;
      font-weight: 300;
      letter-spacing: 10px;
      margin-top: -20px;
    }
  </style>
</head>
<!-- #003b95 couleur primaire -->
<body style="background-color: #003b95">
  <div class="login-container">
    <div class="logo">
      <div class="buro">BURO</div>
      <div class="store">STORE</div>
    </div>
    
    <div class="login-title">ESPACE ADMIN</div>

    <form class="formConnexion" method="POST">
      <div class="form-group">
        <label for="tel">Numéro de téléphone</label>
        <div class="input-group">
          <span><i class="fa fa-phone"></i></span>
          <!-- <input type="tel" name="tel" id="tel" value="0766906577" maxlength="10"
            oninput="validatePhoneNumber('tel', 'telError', 'networkLogo')"
            placeholder="Entrer le numéro de téléphone"> -->
          <input type="tel" name="tel" id="tel" value="0566015517" maxlength="10"
            oninput="validatePhoneNumber('tel', 'telError', 'networkLogo')"
            placeholder="Entrer le numéro de téléphone">
          <span id="networkLogo"></span>
        </div>
        <div class="error-message" id="telError"></div>
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="input-group">
          <span><i class="fa fa-lock"></i></span>
          <input type="password" name="password" id="password" value="ADMIN-01" placeholder="Entrer le mot de passe">
          <!-- <input type="password" name="password" id="password" value="AGENT-01" placeholder="Entrer le mot de passe"> -->
          <span onclick="togglePassword()"><i class="fa fa-eye" id="togglePasswordIcon"></i></span>
        </div>
        <div class="error-message" id="passwordError"></div>

      </div>

      <button type="submit" class="btn btnConnexion">Se connecter <i class="fa fa-sign-in"></i></button>
    </form>
      <footer class="text-center">
    &copy; 2025 BURO STORE. Tous droits réservés.
  </footer>

  </div>


  <?php require_once 'inc/links/footer.php'; ?>
</body>

</html>

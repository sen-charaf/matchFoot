<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Login page</title>
    <link rel="stylesheet" href="./styles/style.css">
    
  </head>
  <body>
    <div class="login-container">
      <div class="login-card">
          <img src="./assets/logoProMax.jpg" alt="Logo" class="logo">
          <h2>SoftFootball</h2>
          <p>Connectez-vous pour accéder à votre espace.</p>
  
          <form id="form_signin" method="POST">
              <div class="input-group">
                  <label for="email">Adresse Email</label>
                  <input type="email" id="email" name="email" placeholder="Votre adresse mail" required>
              </div>
  
              <div class="input-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
              </div>
  
              <button type="submit">Se Connecter</button>
          </form>
  
          <div class="links">
              <p><a href="Signup.php">Créer un compte</a></p>
              <p><a href="ForgotPassword.php">Mot de passe oublié ?</a></p>
          </div>
      </div>
  </div>
    <form id="form_signin">
      
    </form>
    <script>
        const form = document.getElementById("form_signin");
        form.addEventListener("submit",(e)=>{
            e.preventDefault();
            const formData = new FormData(form);
            fetch("http://efoot/login",{
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
            })
            .catch( err => {
                console.error(err);
            })
        })

    </script>
  </body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<?php
    require('./header.php');
?>
<h1>Inscription Client</h1>
      <form method="post" action="./ajoutClient.php">
          <div class="form-group">
              <label for="nom"> Nom </label>
              <div class="input-group">
                  <input type="text" name="nom">
              </div>
          </div>
          <div class="form-group">
              <label for="prenom"> Prénom </label>
              <div class="input-group">
                  <input type="text" name="prenom">
              </div>
          </div>
          <div class="form-group">
              <label for="mail"> Adresse email </label>
              <div class="input-group">
                  <input type="text" name="mail">
              </div>
          </div>
          <div class="form-group">
              <label for="password"> Mot de passe </label>
              <div class="input-group">
                  <input type="password" name="password">
              </div>
          </div>
          <div class="form-group">
              <label for="password2"> Confirmation </label>
              <div class="input-group">
                  <input type="password" name="password2">
              </div>
          </div>
          <div class="form-group">
              <label for="telClient"> Téléphone </label>
              <div class="input-group">
                  <input type="text" name="telClient">
              </div>
          </div>
      </form>
</body>

<?php
    require('./footer.php');
?>
</html>

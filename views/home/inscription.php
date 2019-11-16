<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <script language="javascript" type="text/javascript" src="assets/js/registration.js"></script>
</head>

<body>
  <div id="heading">
    <h1>Inscription</h1>
  </div>

  <section id="main" class="wrapper">
    <div class="inner">
      <div class="content">

        <div class="row">
          <div class="col-6 col-12">
            <form method="post" action="?controller=Home&action=saveUser" name="inscription" onsubmit="return formValidation()">
              <div class="row gtr-uniform">
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="prenom" placeholder="Prenom" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="fonction" placeholder="Fonction" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="departement" placeholder="Departemennt" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="login" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="password" name="password" placeholder="Mot De Passe" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="matricule" placeholder="Matricule" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="num_tel" placeholder="Numero de Telephone" required>
                </div>
                <div class="col-6 col-12-xsmall">
                  <input type="text" name="emplacement" placeholder="Lieu" required>
                </div>
                <div class="col-12">
                  <ul class="actions">
                    <li><input type="submit" value="S'inscrire" id="submit" class="primary"></li>
                    <li><input type="reset" value="Annuler"></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>

function formValidation() {
  var uid = document.inscription.login;
  var passid = document.inscription.password;
  var uname = document.inscription.nom;
  var uprenom = document.inscription.prenom;
  var udepartement = document.inscription.departement;
  var ufonction = document.inscription.fonction;
  var uadd = document.inscription.emplacement;
  var unumtel = document.inscription.num_tel;
  var umatricule = document.inscription.matricule;
  if (allLetterNom(uname)) {
    if (allLetterPrenom(uprenom)) {
      if (allLetterFonction(ufonction)) {
        if (allLetterDepartement(udepartement)) {
          if (userid_validation(uid, 5, 12)) {
            if (passid_validation(passid, 7, 12)) {
              if (allnumericMatricule(umatricule)) {
                if (allnumericNum(unumtel)) {
                  alert('Inscription effectue avec succes');
                  return true;
                }
              }
            }
          }
        }
      }
    }
  }
  return false;
}

function userid_validation(uid, mx, my) {
  var uid_len = uid.value.length;
  if (uid_len == 0 || uid_len >= my || uid_len < mx) {
    alert("Nom d'utilisateur doit etre entre " + mx + " et " + my);
    uid.focus();
    return false;
  }
  return true;
}

function passid_validation(passid, mx, my) {
  var passid_len = passid.value.length;
  if (passid_len == 0 || passid_len >= my || passid_len<mx) {
    alert("Mot de Passe doit etre entre" + mx + " et " + my);
    passid.focus();
    return false;
  }
  return true;
}

function allLetterNom(uname) {
  var letters = /^[A-Za-z]+$/;
  if (uname.value.match(letters)) {
    return true;
  } else {
    alert('Nom doit contenir des lettres seulement');
    uname.focus();
    return false;
  }
}

function allLetterPrenom(uprenom) {
  var letters = /^[A-Za-z]+$/;
  if (uprenom.value.match(letters)) {
    return true;
  } else {
    alert('Prenom doit contenir des lettres seulement');
    uprenom.focus();
    return false;
  }
}

function
allLetterDepartement(udepartement) {
  var letters = /^[A-Za-z]+$/;
  if (udepartement.value.match(letters)) {
    return true;
  } else {
    alert('Departement doit contenir des lettres seulement');
    udepartement.focus();
    return false;
  }
}

function allLetterFonction(ufonction) {
  var letters = /^[A-Za-z]+$/;
  if (ufonction.value.match(letters)) {
    return true;
  } else {
    alert('Fonction doit contenir des lettres uniquement');
    ufonction.focus();
    return false;
  }
}

function allnumericNum(unumtel) {
  var numbers = /^[0-9]+$/;
  if (unumtel.value.match(numbers)) {
    return true;
  } else {
    alert('Numero doit contenir des chiffres uniquement');
    unumtel.focus();
    return false;
  }
}

function allnumericMatricule(umatricule) {
  var numbers = /^[0-9]+$/;
  if (umatricule.value.match(numbers)) {
    return true;
  } else {
    alert('Matricule doit contenir des chiffres uniquement');
    umatricule.focus();
    return false;
  }
}

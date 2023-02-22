/* on récupère l'identifiant du bouton qui affiche le popup*/
var btn = document.getElementById("btn");
/* on rècupère l'id du overlay car c'est ce qu'on veut afficher*/
var overlay = document.getElementById("overlay");
/*on récupère le bouton qui ferme le popup */
var btnClose = document.getElementById("btnClose");

/* on ajoute un gestionnaire d'évènement de telle manière que lorsqu'on clique sur le bouton qui affiche le popup il affiche l'overlay*/

btn.addEventListener("click", openModal);
// function qui définit le style à block
function openModal() {
  overlay.style.display = "block";
}

// on ajoute un évènement sur le bouton btnClose

btnClose.addEventListener("click", closePopup);

// on définit la function closePopup

function closePopup() {
  overlay.style.display = "none";
}

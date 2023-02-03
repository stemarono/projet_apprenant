// on va chercher les différents éléments de la page
const pages = document.querySelectorAll(".page")
const header = document.querySelector(".header")
const nbPages = pages.length // nombre de pages du formulaire
let pageActive = 1

// on attend le chargement de la page
window.onload = () => {
    // on affiche la premiere page du formulaire
    document.querySelector(".page").style.display = "initial"

    // on affiche les numéros des pages dans l'en-tête
    // on parcourt la liste des pages
    pages.forEach((page, index) => {
        // on crée l'élément "numéro de page"
        let element = document.createElement("div")
        element.classList.add("page-num")
        element.id = "num" + (index + 1)

        if(pageActive === index + 1) {
            element.classList.add("active")
        }
        element.innerHTML = index + 1
        header.appendChild(element)
    })

    // on gère les boutons "suivant"
    let boutons = document.querySelectorAll("button[type=button]")

    for(let bouton of boutons){
        bouton.addEventListener("click", pageSuivante)
    }
}

// on crée la fonction qui fait avancer le formulaire d'une page
function pageSuivante() {
   
    // on masque toutes les pages
    for(let page of pages) {
        page.style.display = "none"
    }

    // on affiche la page suivante
    this.parentElement.parentElement.nextElementSibling.style.display = "initial"

    // on "désactive" la page active
    document.querySelector(".active").classList.remove("active")
     
    // on incrémente pageActive
     pageActive++

}

// on crée la fonction qui fait avancer le formulaire d'une page
function pagePrecedente() {
   
    // on masque toutes les pages
    for(let page of pages) {
        page.style.display = "none"
    }

    // on affiche la page suivante
    this.parentElement.parentElement.nextElementSibling.style.display = "initial"

    // on "désactive" la page active
    document.querySelector(".active").classList.remove("active")
     
    // on incrémente pageActive
     pageActive++

}
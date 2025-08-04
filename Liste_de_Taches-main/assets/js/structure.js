

let listeDeTaches = [];


function ajouterTache(x){ 
    listeDeTaches.push(x);
}


function afficherTache() {
    document.querySelector("#tasklist").innerHTML = "";
    for (let x = 0; x < listeDeTaches.length; x++) {
        let newLi = document.createElement("li");

        // une checkbox
        let newInput = document.createElement("input");
        newInput.type = "checkbox";

        // le texte mis dans un span
        let taskText = document.createElement("span");
        taskText.textContent = listeDeTaches[x];

         // Un Bonus qui fait que le texte est barré quand je coche ma tache
        newInput.addEventListener("change", function () {
        if (newInput.checked) {
            taskText.style.textDecoration = "line-through";
        } else {
            taskText.style.textDecoration = "none";
        }
    })

        // le boutton supprimer
        let bouton = document.createElement("button");
        bouton.id = "supprimer";
        bouton.textContent = "🗑️";

        // je met le addeventlistener içi parce que je supprime tout l'intérieur de #tasklist plus haut
        // dans le code à chaque fois que je click sur le bouton.
        bouton.addEventListener("click", function () {
            supprimerTache(x);
        });

        // je rajoute tout a mon nouveau li
        newLi.appendChild(newInput);
        newLi.appendChild(taskText);
        newLi.appendChild(bouton);

        // le nouveau li est ajouté au ul
        document.querySelector("#tasklist").appendChild(newLi);
    }
}

// supprimer tâche 

function supprimerTache(x){
    listeDeTaches.splice(x, 1);
    afficherTache();
}

// le bouton Ajouter

document.querySelector("#addtaskbutton").addEventListener("click",function(){
    // si la tache est vide ou plus que 4 lettres, la fonction ne laissera pas passer
    if (document.querySelector("#taskinput").value == "" || document.querySelector("#taskinput").value.length <= 3 ){
        alert("Tu dois écrire une tâche d'abord.");
    }
    else{
    ajouterTache(document.querySelector("#taskinput").value);
    afficherTache();
    document.querySelector("#taskinput").value = "";
    }
})

// --------------------------------------- BONUS  --------------------------------------------------------

// J'ai mis 2, 3 trucs quality of life

// dark mode


let dark = false;

document.querySelector("#dark-light").addEventListener("click", function(){
    if (dark == false){
        document.body.style.backgroundColor ="#27548A";
        document.body.style.color = "#FCF8DD";
        document.querySelector("#dark-light").textContent = "Or Mode";
        document.querySelector("#dark-light").style.backgroundColor = "#DDA853"; 
        dark = true;
    }
    else{
        document.body.style.backgroundColor ="#DDA853";
        document.body.style.color = "#27548A";
        document.querySelector("#dark-light").textContent = "Blue Mode";
        document.querySelector("#dark-light").style.backgroundColor = "#27548A";
        dark = false;
    }

})

// pour que la touche entrée fonctionne aussi
document.querySelector("#taskinput").addEventListener("keydown", function(x){
    if(x.key === "Enter"){
        document.querySelector("#addtaskbutton").click();
    }
})

// Une liste de tâches auto qui s'ajoute si on clique sur le bouton "Auto Tâche"

let listeAFaire = [
  "Faire la vaisselle",
  "Passer l'aspirateur",
  "Sortir les poubelles",
  "Faire la lessive",
  "Arroser les plantes",
  "Nettoyer la salle de bain"
];


// je met la tache dans la value de l'input

document.querySelector("#flemme").addEventListener("click", function(){
    document.querySelector("#taskinput").value = listeAFaire[Math.floor(Math.random() * listeAFaire.length)];
})

// trier par ordre alphabetique

document.querySelector("#trier").addEventListener("click", function(){
    listeDeTaches.sort();
    afficherTache();
})
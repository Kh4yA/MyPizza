const monForm = document.getElementById("monform");
const contentPizza = document.querySelector(".content-pizza")
const ingredientPizza = document.querySelector(".ingredient-pizza")
const sumPizza = document.querySelector(".sum-pizza")
console.log(contentPizza);
console.log("coucou");
// Fonction pour soumettre le formulaire
function submitForm() {
    const formData = new FormData(monForm);
    
    console.log("Formulaire soumis");
    
    // Envoi des données avec fetch
    fetch("http://pizza.mdaszczynski.mywebecom.ovh/controller/prepareJSON", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        genereContenuPizza(data.pizza)
        genereContenuIngredient(data.ingredients)
        sumTotal(data.pizza)
        })
        .catch((error) => {
            console.error(error);
        });
}
// TRITEMENT DES RADIOS
monForm.querySelectorAll("[type=radio]").forEach(element => {
    element.addEventListener("click", (e) => {
        console.log(`Changement détecté sur ${e.target.name}: ${e.target.value}`);
        submitForm();
    });
});
/**
 * genere le contenu html de la decription de la pizza
 * @param {object} data 
 * @return neant
 */
function genereContenuPizza(data) {
    contentPizza.innerHTML = ""
    contentPizza.innerHTML = `
    <h3 class="text-center">Votre séléction :</h3>
    <ul>
    <li>Prix de la pizza : 7,90€</li>
    <li>Type de pâte : ${data.type_pate}</li>
    <li>Taille : ${data.taille}</li>
    <li>Sauce : ${data.base}</li>
    <li>description : votre pizza est composé d'une pâte ${data.type_pate} avec une sonctueuse base ${data.base}.</li>
    </ul>
    <br>
    `
}
// TRAITEMENT DES CHECKBOX
const checkbox = document.querySelectorAll("[type=checkbox]")
checkbox.forEach(element => {
    element.addEventListener("click", (e) => {
        console.log(`Changement détecté sur ${e.target.name}: ${e.target.value}`);
        console.log(e.target);
        const formData = new FormData(monForm);
        console.log(formData);
        // on envoie que la valeur cliqué
        fetch(`http://pizza.mdaszczynski.mywebecom.ovh/controlller/modifierIngredient`,{
            method: "POST",
            body: formData
        })
        submitForm();
    });
});
/**
 * genere le contenu html de la decription des ingredients
 * @param {object} data 
 * @return neant
 */
function genereContenuIngredient(data) {
    ingredientPizza.innerHTML = ""
    data.forEach(elt => {
        console.log(elt);
        ingredientPizza.innerHTML += `
        <p>${elt.ingredient_nom} : + ${elt.prix_ingredient}€</p>
        `
    })
}
function sumTotal(data){
    sumPizza.innerHTML = ""
    sumPizza.innerHTML = `
    <div class="sum-pizza large-12 flex item-center justify-center">
        <p>Total</p>
        <p>${data.prix}€</p>
    </div>
    `
}


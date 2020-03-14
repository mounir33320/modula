//Fonction pour afficher un message d'alert dans le formulaire
let alertMessage = function(bool){
	let divAlert = document.createElement("div");
	divAlert.classList.add("text-center");
	divAlert.classList.add("alert");
	divAlert.setAttribute("role", "alert")
	
	document.querySelector("#alert").appendChild(divAlert);
	
	if(bool === true){
		divAlert.classList.add("alert-success");
		divAlert.innerHTML = "Votre message a été envoyé avec succès !";
	}
	else{
		divAlert.classList.add("alert-danger");
		divAlert.innerHTML = "Les données entrées ne sont pas correctes !";
	}
}

//Fonction pour vérifier que les champs ne sont pas vides
let notEmpty = function(string){
	if(string.length > 0){
		return true;
	}else{
		return false;
	}
}

//Fonction permettant la validation des adresses email
let mailValide = function(string){
	let regex = new RegExp("^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z0-9]{2,4}$");
	return regex.test(string);
}

//Traitement des données du formulaire
let form = document.querySelector("#form");

form.addEventListener("submit", function(e){
	e.preventDefault();

	let firstname = form.elements.firstname.value;
	let lastname = form.elements.lastname.value ;
	let email = form.elements.email.value;
	let message = form.elements.message.value;

	if(notEmpty(lastname) && notEmpty(firstname) && notEmpty(email) && notEmpty(message)){
		if(mailValide(email)){
			let xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if(xhr.readyState === 4){
					if(xhr.status >= 200 && xhr.status < 400){
						alertMessage(true);
					}
				}
			}
			xhr.open("POST", "treatment.php", true);
			let data = new FormData(form);
			xhr.send(data);
		}else{
			alertMessage(false);
		}
	}else{
		alertMessage(false);
	}
})
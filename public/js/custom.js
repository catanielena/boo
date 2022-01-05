//
//
// Funzioni
//
//
// mostra l'immagine caricata
// const uploadedImage = function(idInput, idImage) {
//     document.getElementById(idInput).addEventListener('change', function () {
//         var src = URL.createObjectURL(this.files[0])
//         document.getElementById(idImage).src = src
//     })   
// }

// // call della funzione uploadedImage
// uploadedImage('image', 'foodEditPreview');
// uploadedImage('image', 'foodCreatePreview');
// uploadedImage('image', 'businessLogo');
// uploadedImage('image1', 'businessCover');


// {-- mostra l'errore associato all'input --}
function setErrorFor(input, message) {
	var formControl = input.parentElement; //.form-control
	var small = formControl.querySelector('small');
	//add error message inside small
	small.innerHTML = message;
	//add error class
	small.className = 'error';
}
// {-- creare la classe success associato all'input --}
function setSuccessFor(input) {
	var formControl = input.parentElement; //.form-control
	var small = formControl.querySelector('small');
	small.innerHTML = "";
	small.className = 'success';
}
// {-- estensione del file --}
function fileType(file) {
	return file.value.substring(file.value.lastIndexOf('.') + 1);
}
function fileSize(file) {
	return file.files[0].size;
}
function fileExists(file) {
	if(file.files.length > 0) {
		return true;
	}
	return false;
}
//
//
// Generale
//
//
const maxfilesize = 2000 * 2000;
//
//
// Modale delete
//
//
const deleteButtons = document.querySelectorAll(".btn-delete");
const inputDeleteID = document.getElementById("delete-id")
// {-- assegna all'input nascosto l'id del piatto --}
deleteButtons.forEach(
	(elm) => {
		elm.addEventListener("click", function () {
			inputDeleteID.value = this.getAttribute("data-id");
		});
	}
);
//
//
//
// Validazione form register
//
//
// {-- form register --}
var registerForm = document.forms["registerForm"];
// {-- messaggio confir password live--}
var password = registerForm.elements["userPassword"];
var passwordConfirm = registerForm.elements["password-confirm"];
passwordConfirm.addEventListener('input', function () {
	if (password.value != passwordConfirm.value) {
		setErrorFor(passwordConfirm, 'La password non coincide')
	} else if (password.value == passwordConfirm.value) {
		setErrorFor(passwordConfirm, '')
	}
})
// {-- cuisinesError --}
var cuisinesError = document.getElementById("cuisines_error");
// {-- validazione register --}
function validateRegister() {
	let allowedExtension = ["jpg", "jpeg", "png", "svg"];
	// {-- input register --}
	const userName = registerForm.elements["name"];
	const email = registerForm.elements["email"];
	const vat_numb = registerForm.elements["vat_numb"];
	const business_name = registerForm.elements["business_name"];
	const business_address = registerForm.elements["business_address"];
	const business_logo = registerForm.elements["image"];
	const business_cover = registerForm.elements["image1"];
	const cuisines = document.getElementsByName("cuisines[]");
	let userNameValue = userName.value;
	let emailValue = email.value;
	let passwordValue = password.value;
	let vat_numbValue = vat_numb.value;
	let business_nameValue = business_name.value;
	let business_addressValue = business_address.value;
	let passwordConfirmValue = passwordConfirm.value;
	// {--  userName --}
	if (userNameValue == "" || userNameValue == null) {
		setErrorFor(userName, 'Inserisci il nome')
		return false;
	} else if (userNameValue.length > 255) {
		setErrorFor(userName, 'Il nome accetta un massimo di 255 caratteri')
		return false;
	} else {
		setSuccessFor(userName);
	}
	// {--  email --}
	if (emailValue == "" || emailValue == null) {
		setErrorFor(email, 'Inserisci l\'email');
		return false;
	} else if (emailValue.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) == null) {
		setErrorFor(email, 'La formattazione della password non è corretta')
		return false;
	} else {
		setSuccessFor(email);
	}
	// {--  password --}
	if (passwordValue == "" || passwordValue == null) {
		setErrorFor(password, 'Inserisci la password')
		return false;
	} else if (passwordValue.length < 8) {
		setErrorFor(password, 'La password deve avere un minimo di 8 caratteri')
		return false;
	} else if (passwordValue != passwordConfirmValue) {
		setErrorFor(passwordConfirm, 'La password non coincide')
	} else {
		setSuccessFor(password);
		setSuccessFor(passwordConfirm);
	}
	// {-- vat_numb --}
	if (vat_numbValue == "" || vat_numbValue == null) {
		setErrorFor(vat_numb, 'Inserisci la partita iva')
		return false;
	} else if (vat_numbValue.match(/^[0-9]+$/) == null) {
		setErrorFor(vat_numb, 'Attenzione la partita iva può essere formata solo da numeri')
		return false;
	} else if (vat_numbValue.length != 11) {
		setErrorFor(vat_numb, 'La partita iva deve essere formata da 11 numeri')
		return false;
	} else {
		setSuccessFor(vat_numb);
	}
	// {-- business_name --}
	if (business_nameValue == "" || business_nameValue == null) {
		setErrorFor(business_name, 'Inserisci il nome dell\'attività')
		return false;
	} else if (business_nameValue.length > 30) {
		setErrorFor(business_name, 'Il nome dell\'attività accetta un massimo di 30 caratteri')
		return false;
	} else {
		setSuccessFor(business_name);
	}
	// {-- business_address --}
	if (business_addressValue == "" || business_addressValue == null) {
		setErrorFor(business_address, 'Inserisci l\'indirizzo dell\'attività')
		return false;
	} else if (business_addressValue.match(/^[\w\s.-]+\d+$/) == null) {
		setErrorFor(business_address, 'Inserire il numero della via')
		return false;
	} else if (business_addressValue.length > 100) {
		setErrorFor(business_address, 'L\'indirizzo dell\'attività accetta un massimo di 100 caratteri')
		return false;
	} else {
		setSuccessFor(business_address);
	}
	// {-- business_logo --}
	if (fileExists(business_logo)) {
		if (allowedExtension.includes(fileType(business_logo)) == false) {
			setErrorFor(business_logo, 'Il file deve essere di tipo jpg, jpeg, png, svg');
			return false;
		} else if (fileSize(business_logo) > maxfilesize) {
			setErrorFor(business_logo, 'Il file supera 1MB');
			return false;
		} else {
			setSuccessFor(business_logo);
		}
	}
	// {-- business_cover --}
	if (fileExists(business_cover)) {
		if (allowedExtension.includes(fileType(business_cover)) == false) {
			setErrorFor(business_cover, 'Il file deve essere di tipo jpg, jpeg, png, svg');
			return false;
		} else if (fileSize(business_cover) > maxfilesize) {
			setErrorFor(business_cover, 'Il file supera 1MB');
			return false;
		} else {
			setSuccessFor(business_cover);
		}
	}
	// {-- cuisines --}
	let i = 0;
	let cuisinesIsValid = false;
	for (let i = 0; i < cuisines.length; i++) {
		if (cuisines[i].checked) {
			cuisinesIsValid = true;
			break;
		}
	}
	if (cuisinesIsValid == false) {
		cuisinesError.innerHTML = 'Aggiungere almeno una tipologia di cucina';
		cuisinesError.className = 'error';
		return false;
	} else {
		cuisinesError.className = 'success';
	}
	return true;
}
//
//
// Validazione food 
//
//
// const foodWeight = document.getElementById("weight");
// const foodVisible = document.getElementById("visible");
// {-- validazione food --}
// function submitFood() {
	// 	return validateFood()
	// }
function validateFood() {
	let allowedExtension = ["jpg", "jpeg", "png", "svg"];
	const maxfilesize = 2000 * 2000;
	let price = document.getElementById("price");
	price.value = Number(price.value.replace(/,/g, '.')).toFixed(2);
	// {-- input register --}
	const foodName = document.getElementById("name");
	const foodImage = document.getElementById("image");
	const foodDescription = document.getElementById("description");
	const foodAllergens = document.getElementById("allergens");
    const foodWeight = document.getElementById("weight");
	const foodPrice = document.getElementById("price");
	let foodNameValue = foodName.value;
	let foodDescriptionValue = foodDescription.value;
	let foodAllergensValue = foodAllergens.value;
	let foodPriceValue = price.value;
	let foodWeightValue = foodWeight.value;
	// let foodVisibleValue = foodVisible.value;
	// {--  foodName --}
	if (foodNameValue == "" || foodNameValue == null) {
		setErrorFor(foodName, 'Inserisci il nome')
		return false;
	} else if (foodNameValue.length > 50) {
		setErrorFor(foodName, 'Il nome accetta un massimo di 255 caratteri')
		return false;
	} else {
		setSuccessFor(foodName);
	}
	// {--  foodImage --}
	if (fileExists(foodImage)) {
		if (allowedExtension.includes(fileType(foodImage)) == false) {
			setErrorFor(foodImage, 'Il file deve essere di tipo jpg, jpeg, png, svg');
			return false;
		} else if (fileSize(foodImage) > maxfilesize) {
			setErrorFor(foodImage, 'Il file supera 1MB');
			return false;
		} else {
			setSuccessFor(foodImage);
		}
	}
	// {--  foodDescription --}
	if (foodDescriptionValue !== 'undefined') {
		if (foodDescriptionValue.length > 255) {
			setErrorFor(foodDescription, 'Questo campo accetta un massimo di 255 caratteri');
			return false;
		} else {
			setSuccessFor(foodDescription);
		}
	}
	// {--  foodAllergens --}
	if (foodAllergensValue !== 'undefined') {
		if (foodAllergensValue.length > 255) {
			setErrorFor(foodAllergens, 'Questo campo accetta un massimo di 255 caratteri');
			return false;
		} else {
			setSuccessFor(foodAllergens);
		}
	}
	// {--  foodWeight --}
	if (foodWeightValue !== '') {
		if (foodWeightValue == "" || foodWeightValue == null) {
			setErrorFor(foodWeight, 'Inserisci il prezzo')
			return false;
		} else if (foodWeightValue.match(/^[0-9]*$/) == null || foodWeightValue < 0) {
			setErrorFor(foodWeight, 'Il prezzo accetta solo numeri positivi interi')
			return false;
		}
	} else {
		setSuccessFor(foodWeight);
	}
	// {--  foodPrice --}
	if (foodPriceValue == 0) {
		setErrorFor(foodPrice, 'Inserisci il prezzo')
		return false;
	} else if (foodPriceValue.match(/^[0-9,.]*$/) == null || foodPriceValue < 0) {
		setErrorFor(foodPrice, 'Il prezzo accetta solo numeri positivi')
		return false;
	} else {
		setSuccessFor(foodPrice);
	}
	return true
}

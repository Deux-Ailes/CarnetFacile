

//////////////////////////////////CONNECTION & REGISTRATION PAGE////////////////////////////

const inputs = document.querySelectorAll(".input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});


function checkpassword(form)
{
	password1 = form.password.value;
	password2 = form.checkpassword.value;

	if(password1=='')
	{
		alert("Veuillez saisir un mot de passe");
		return false;
	}

	else if(password2=='')
	{
		alert("Veuillez saisir la confirmation de mot de passe");
		return false;
	}

	else if(password1 != password2)
	{
		alert("Les mots de passes sont différents");
		return false
	}

	else
	{
		return true;
	}
}


//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////AJAX TREATMENT//////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////
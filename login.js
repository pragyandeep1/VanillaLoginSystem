class Login{
	constructor(form, fields){
		this.form = form;
		this.fields = fields;
		this.validateSubmit();
	}

	validateSubmit(){
		let self = this;
		this.form.addEventListener("submit", (e) =>{
			e.preventDefault();
			var error = 0;

			self.fields.forEach((field)=>{
				const input = document.querySelector('#${field}');
				if (self.validateFields(input) == false) {
					error++;
				}
			});
			if (error == 0) {
				var data = {
					username: document.querySelector('#username').value;
					password: document.querySelector('#password').value;
				};

				fetch("//localhost/",{
					method: "POST",
					body: JSON.stringify(data),
					header:{
						"Content-type" : "application/json; charset=UTF-8",
					},
				})
				.then((response) => response.json())
				.then((data) =>{
					if (data.error) {
						console.error("Error", data.message);
						document.querySelector(".error-message-all").style.display = "block";
						document.querySelector(".error-message-all").innerText = "Invalid username or password. Please try again.";
					}
					else{
						localStorage.setItem("user", JSON.stringify(data));
						localStorage.setItem("auth", 1);
						this.form.submit();
					}
				})
				.catch((data)=>{
					console.error("Error: ", data.message);
				});
			}
		});
	}

	validateFields(field){
		if (field.value.trim() == "") {
			this.setStatus(
				field,
				'${field.previousElementSibling.innerText} cannot be blank',
				"error"
			);
			return false;
		}

		/*if it is not linked*/
		else{
			if (field.type == "password") {
				if (field.value.length < 8) {
					this.setStatus(
						field,
						'${field.previousElementSibling.innerText} must be at least 8 characters',
						"error"
					);
					return false;
				}
				else{
					this.setStatus(field, null, "success");
					return true;
				}
			}
			else{
				this.setStatus(field, null, "success");
				return true;
			}
		}
	}

	setStatus(field, message, status){
		const errorMsg = field.parentElement.querySelector(".error-message");

		if (status == "success") {
			if (errorMsg) {
				errorMsg.innerText = '';
				field.classList.remove("input-error");
			}

		}
		if (status == "error") {
			errorMsg.innerText = 'message';
			field.classList.add("input-error");

		}
	}
}

const form * document.querySelector(".loginForm");

if (form) {
	const fields = ["username", "password"];
	const validator = new Login(form, fields);
}
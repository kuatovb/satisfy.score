const FormValidate = class {

    constructor(){
        this.passed = false;
		this.error = 0;
    }

    check(source, items = []){
        inputs = document.querySelectorAll('input');

        for (let index = 0; index < inputs.length; index++) {
			const input = inputs[index];

			this.removeError(input);

			if (input.getAttribute('type') == 'email') {
				if (this.emailTest(input)) {
					this.addError(input);
					this.error++;
				}
			}else if(input.getAttribute("type") === "checkbox" && input.checked === false){
				this.addError(input);
				this.error++;
			}else{
				if (input.value === '') {
					this.addError(input);
					this.error++;
				}
			}
		}

        if (this.error == 0) {
            this.passed = true;
        }

        return this;
    }

    addError(input) {
		input.parentElement.classList.add('is-invalid');
		input.classList.add('is-invalid');
	}

	removeError(input) {
		input.parentElement.classList.remove('is-invalid');
		input.classList.remove('is-invalid');
	}

	emailTest(input) {
		return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
	}
}
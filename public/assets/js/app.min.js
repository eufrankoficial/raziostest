focusElement('nome');
focusElement('celular');
focusElement('cep');
focusElement('bairro');
focusElement('numero');
focusElement('endereco');
focusElement('cidade');
focusElement('estado');
focusElement('observacao');

function focusElement(id) {
	document.getElementById(id).onfocus = function() {
		onFocusElement(id);
	}

	document.getElementById(id).onblur = function() {
		onFocusOutElement(id);
	}
}

function onFocusElement(id) {
	var element = document.getElementById(id).parentElement;

	element.classList.add('highlight');
}

function onFocusOutElement(id) {
	var element = document.getElementById(id).parentElement;
	element.classList.remove('highlight');
}
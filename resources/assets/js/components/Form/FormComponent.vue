<template>
	<div class="form-container">
		<div class="loading" v-show="loading">
			Carregando...
		</div>

		<form>
			<div :class="errorNome ? 'input error' : 'input'">
				<label class="label-input" v-bind:class="errorNome ? 'error-label' : ''">NOME</label>
				<input type="text" id="nome" v-bind:class="errorNome ? 'error-input' : ''" v-model="nome">
			</div>

			<div class="input">
				<label class="label-input">CELULAR</label>
				<input type="text" id="celular" v-model="celular" v-mask="'(##) #####-####'">
			</div>

			<div class="input">
				<label class="label-input">CEP</label>
				<input type="text" id="cep" v-model="cep" v-mask="'########' "@change="onChangeCep($event)">
			</div>

			<div class="input" v-bind:class="errorEndereco ? 'error' : ''">
				<label class="label-input" v-bind:class="errorEndereco ? 'error-label' : ''">ENDEREÇO</label>
				<input type="text" id="endereco" v-bind:class="errorEndereco ? 'error-input' : ''" v-model="endereco">
			</div>

			<div class="input">
				<label class="label-input">NÚMERO</label>
				<input type="text" id="numero" v-model="numero">
			</div>

			<div :class="errorBairro ? 'input error' : 'input'">
				<label :class="errorBairro ? 'label-input error-label' : 'label-input'">BAIRRO</label>
				<input type="text" :class="errorBairro ? 'error-input' : ''" id="bairro" v-model="bairro">
			</div>

            <div class="input">
                <label class="label-input">COMPLEMENTO</label>
                <input type="text" id="complemento" v-model="complemento">
            </div>

			<div class="input" v-bind:class="errorCidade ? 'error' : ''">
				<label class="label-input" v-bind:class="errorCidade ? 'error-label' : ''">CIDADE</label>
				<input type="text" id="cidade" v-bind:class="errorCidade ? 'error-input' : ''" v-model="cidade">
			</div>

			<div class="input" v-bind:class="errorEstado ? 'error' : ''">
				<label class="label-input" v-bind:class="errorEstado ? 'error-label' : ''">ESTADO</label>
				<input type="text" id="estado" v-bind:class="errorEstado ? 'error-input' : ''" v-model="estado" @change="onChangeCep($event)">
			</div>

			<div class="input">
				<label class="label-input">OBSERVAÇÃO</label>
				<textarea id="observacao" v-model="observacao"></textarea>
			</div>

			<div class="btn">
				<button @click="checkFormOnSubmit($event)" :disabled="disabled">
					{{ txtBtn }}
				</button>
			</div>
		</form>
	</div>

</template>

<script>

	import VueMask from 'v-mask'

	import { api } from '../../config';
	import { validateFieldString, isValidDate, validateEmail } from '../../config/validate';
	import { getCep } from '../../config/cep';

	Vue.use(VueMask);
    export default {

        data() {
        	return {
        		nome: null,
        		errorNome: false,
        		email: null,
        		errorEmail: false,
        		celular: null,
        		cep: null,
        		endereco: null,
        		numero: null,
        		bairro: null,
                errorBairro: null,
                complemento: null,
        		errorEndereco: false,
        		cidade: null,
        		errorCidade: false,
        		estado: null,
        		errorEstado: false,
        		observacao: null,
        		id: null,
        		disabled: false,
        		txtBtn: 'Enviar',
        		showForm: true,
        		loading: false
        	}
        },

        methods: {
        	checkFormOnSubmit: function(event) {
        		event.preventDefault();

        		if(this.showForm) {
	        		this.disabled = true;
	        		this.txtBtn = 'Enviando...';
	        		this.checkForm();
	        		return;
        		}

        		this.txtBtn = 'Enviar';
        	},

        	onChangeEmail: function(event) {
        		const valid = validateEmail(this.email)

        		if(!valid) {
        			this.email = null;
        			this.errorEmail = true;
        			this.$swal('Atenção!', 'Informe o email corretamente', 'error');
        			return;
        		}

        		this.errorEmail = false;
        	},

        	onChangeCep: async function(event) {
                let cep;
                if(this.cep != null && this.cep !== '') {
                    cep = await getCep(this.cep, null);
                } else {
                    const endereco = {
                        uf: this.estado,
                        cidade: this.cidade,
                        logradouro: this.endereco
                    };
                    cep = await getCep(null, endereco);
                }

                const cepString = cep.cep.replace('-', '');

                this.disabled = false;
                this.cep = cepString;
                this.endereco = cep.logradouro;
                this.bairro = cep.bairro;
                this.cidade = cep.localidade;
                this.estado = cep.uf;

                const distancia = await this.calculateLagLong();
                this.observacao = 'Distancia para entrega: ' + distancia.distancia + 'KM';
        	},

        	saveContact: async function () {
        		try {
        			const data = {
	        			nome: this.nome,
		        		email: this.email,
		        		celular: this.celular,
		        		cep: this.cep,
		        		endereco: this.endereco,
                        complemento: this.complemento,
		        		numero: this.numero,
		        		bairro: this.bairro,
		        		cidade: this.cidade,
		        		uf: this.estado,
		        		obs: this.observacao,
		        		id: this.id
	        		};

	        		const response = await api.post('contato', data);

	        		if(response.data.status == true) {
                        this.$swal('Perfeito!', response.data.mensagem, 'success');
                        this.disabled = false;
                        return true;
	        		}

                    this.$swal('Atenção!', 'Não foi possível processar sua requisição', 'error');
	        		return false;
        		} catch (error) {
        			this.disabled = false;
        			this.$swal('Atenção!', 'Não foi possível processar sua requisição', 'error');
        			return false;
        		}
        	},

        	checkForm: async function () {
        		this.errorNome = validateFieldString(this.nome, 3, 'nome').hasError;
        		this.errorEndereco = validateFieldString(this.endereco, 3, 'endereco').hasError;
        		this.errorCidade = validateFieldString(this.cidade, 3, 'cidade').hasError;
        		this.errorEstado = validateFieldString(this.estado, 3, 'estado').hasError;
                this.errorBairro = validateFieldString(this.bairro, 3, 'bairro').hasError;
        		this.errorEmail = validateEmail(this.email) ? false : true;

        		if(this.errorNome || this.errorEndereco || this.errorCidade || this.errorEstado || this.errorEmail || this.errorBairro) {
        			this.$swal('Atenção', 'Preencha os campos corretamente', 'error');
        			this.disabled = false;
        			this.txtBtn = 'Enviar';
        			return;
        		}

        		const save = this.saveContact();

        		if(!save) {
        			this.txtBtn = 'Enviar';
        			return false;
        		}

                setTimeout(this.resetForm, 2000);

        	},

            calculateLagLong: async function () {
                const distancia = await api.get('distancia');
                return distancia.data;
            },

        	resetForm: function () {
        		this.nome = null;
    			this.cep = null;
    			this.endereco = null;
    			this.numero = null;
    			this.bairro = null;
    			this.celular = null;
    			this.email = null;
    			this.cidade = null;
    			this.estado = null;
    			this.observacao = null;
    			this.id = null;
    			this.txtBtn = 'Avançar';
        	}
        }
    };
</script>

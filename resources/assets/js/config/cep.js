import axios from 'axios';

export const getCep = async (cep, endereco) => {
	console.log(endereco);

	let response;
	if(endereco === null) {
		response = await axios.get(`https://viacep.com.br/ws/${cep}/json/`);
		return response.data
	} else {
		response = await axios.get(`https://viacep.com.br/ws/${endereco.uf}/${endereco.cidade}/${endereco.logradouro}/json/`);
		return response.data[0];
	}

}
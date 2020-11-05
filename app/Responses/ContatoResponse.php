<?php

namespace App\Responses;

use Carbon\Carbon;

class ContatoResponse
{

	public function response(array $dados): array
	{
		return $this->formataCamposParaRetorno($dados);
	}

	private function formataCamposParaRetorno(array $dados): array
	{
		$contato = $this->contatoExiste($dados);

		if(count($contato) == 0)
			return [];

		return [
			'id' => $contato['id'],
			'nome' => $contato['nome'],
			'cnpj' => $contato['cnpj'],
			'endereco' => $contato['endereco'],
			'numero' => $contato['numero'],
			'bairro' => $contato['bairro'],
			'cep' => $contato['cep'],
			'cidade' => $contato['cidade'],
			'uf' => $contato['uf'],
			'complemento' => $contato['complemento'],
			'dataNascimento' => Carbon::createFromFormat('Y-m-d', $contato['dataNascimento'])->format('d/m/Y'),
			'celular' => $contato['celular'],
			'email' => $contato['email']
		];
	}

	public function contatoExiste($contato): array
	{
		if(isset($contato['erros']))
			return [];

		if(isset($contato['retorno']) && isset($contato['retorno']['contatos']))
			return $contato['retorno']['contatos'][0]['contato'];

		return isset($contato['contatos']) ? $contato['contatos']['contato'] : [];
	}
}
<?php

namespace App\FormClasses;

use App\Enums\ContatoEnum;

class ContatoForm
{
	function preparaCamposParaSalvar(array $dados): array
	{
		$dados['tipoPessoa'] = ContatoEnum::TIPO_PESSOA;
		$dados['contribuinte'] = ContatoEnum::CONTRIBUINTE;
		$dados['fantasia'] = $dados['nome'];
		$dados['emailNfe'] = $dados['email'];

		$dados['tipos_contatos'] = [
			'tipo_contato' => [
				'descricao' => ContatoEnum::TIPO_CONTATO
			]
		];

		return $dados;
	}

}
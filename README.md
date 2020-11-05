
## Instruções para rodar o projeto

Esse projeto precisa da versão 7.3 ou superior do PHP. É importante que tenha instalado o APACHE e o gerenciador de pacotes COMPOSER. Para gerenciamento de interface, é importante que tenha o gerenciador de pacotes npm ou yarn instalado. Tendo essas coisas instaladas, siga as instruções abaixo para rodar o projeto.

- clonar o projeto
- entrar na pasta raiz via linha de comando e rodar composer install ou composer update
- Dar permissão chmod -R 777 na pasta storage e na pasta bootstrap/cache
- Copiar o conteúdo do .env.example para um arquivo na raiz chamado .env
- Rodar o comando php artisan key:generate

- Ainda na linha de comando, rodar yarn install ou npm install
- Logo depois, rodar yarn dev ou npm run dev
- Acesse o endereço local do projeto em seu navegador de preferência e teste
	- ex.: http://localhost/projetolocal/public


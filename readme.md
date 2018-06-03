# Library Music

O Library Music é uma aplicação web para gerenciar uma biblioteca de músicas. Foi desenvolvida utilizando Laravel 5.6, Postgres e Docker. A aplicação possui 3 níveis usuário public(Pode apenas visualizar as informações), user(Pode cri/editar/remover bandas/artistas, álbuns e músicas) e admin(Gerencia toda a aplicação).

## Pré-requisitos

- [Instalar o Docker](https://docs.docker.com/compose/install/).
- Rodar o comando seu terminal git clone https://github.com/gabriel-missali/library-music.git.
- No diretório do projeto criar o .env, rodar o comando cp .env.example .env
- Entrar no projeto e na ir no diretório laradocks e rodar o comando cp env-example .env para criar o arquivo de configuração do docker.
- Após criar o arquivo de configuração rodar o comando docker-compose up --build -d apache2 postgres para criar o workspace.
- No seu navegador entrar no localhost:6060/phppgadmin e logar usuário: default e senha: secret e criar o banco de dados library_music.
- Após criar workspace e o banco de dados, rode o comando docker-compose exec workspace bash.
- Assim que entrar no workspace rodar o comando php artisan migrate para criação das tabelas do banco de dados.
- Após rodar o comando migrate será criado um usuário admin com email: admin@mail.com e senha: 123456.
- Entrar no localhost:6060/public e utilizar a aplicação.

# Como rodar o projeto

Na pasta raiz do repositório rode o comando `docker-compose up -d --build site`, o site ficará disponível em [localhost:8080](http://localhost:8080 "localhost:8080").

## Escopo do projeto (Sistema de gestão de estoque):

O sistema deverá ter uma página para entrada e saída de itens, e uma página onde será possível listar os produtos e fazer consultas. Além disso caso o produto fique com estoque baixo deverá emitir um alerta ao usuário avisando que o produto está quase esgotando.

O usuário padrão terá acesso a todas as páginas principais do sistema, e também poderá redefinir sua própria senha.

O usuário administrador terá permissão para cadastrar, editar e excluir usuários, terá acesso a todas as páginas principais do sistema e terá acesso a uma página de Movimentações onde será possível vizualizar todas as entradas/saídas do estoque.

Nas tabelas de entrada e saída deverá ficar registrado qual usuário realizou a ação para que caso necessário seja possível rastrear através das movimentações.

## Diagrama EER

![](https://i.imgur.com/oofEair.jpeg)

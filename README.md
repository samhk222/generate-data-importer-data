php artisan serve para rodar o projeto

# Criar registros
rota / cria os registros que tu precisa, até budget line items

# Redis
rota `/redis` pega todos os dados que estão no redis, na DB0, e parsei pra gente
Para rodar, eu fui no dbgate, escolhi redis, clique com o botão direto do mouse e mandei `generate script`

![Alt text](image.png)

Salvei o documento no gedit com o nome de redis011 e Ai fui no console, e mandar importar, com `redis-cli -h localhost -p 63790 < redis011`

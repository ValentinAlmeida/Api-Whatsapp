## 🚀 Instalação

> Crie uma network para o banco de dados:
```
docker network create --subnet 10.0.0.0/17 apinetwork
```

> Crie o container do mysql:
```
docker run --name mysql --network=apinetwork --ip=10.0.0.3 -e MYSQL_ROOT_PASSWORD=root -d mysql
```

> Faça a imagme do projeto
```
docker build -t api -f Dockerfile .
```

> Construa o container do projeto
```
docker run -p 6000:6000 -p 5172:5172 --network=apinetwork -v $(pwd):/app -it --name api api /bin/bash
```

> Crie a key
```
make key
```

> Faça a configuração do projeto

```
docker exec -d api bash -c "composer install"

docker exec -d api bash -c "php artisan serve --host 0.0.0.0 --port=6000"

docker exec -d api bash -c "php artisan migrate"

docker exec -d api bash -c "php artisan db:seed"
```

> url local para o projeto http://0.0.0.0:6000/

> 💻 OBS: Configure o env colocando no host do banco o ip 10.0.0.3 no banco de dados

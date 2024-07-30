.PHONY: start stop restart server

start:
	docker stop api
	docker stop mysql
	docker start api
	docker start mysql
	make server
	@echo "Containers iniciados"

stop:
	docker stop api
	docker stop mysql
	@echo "Containers parados com sucesso"

restart: stop start
	@echo "Containers reiniciados com sucesso."

server:
	docker exec -d api bash -c "php artisan serve --host 0.0.0.0 --port=6000"
	docker exec -d api bash -c "npm run dev -- --host"

migrate:
	docker exec api bash -c "php artisan migrate"

seed:
	docker exec api bash -c "php artisan db:seed"

cache:
	docker exec api bash -c "php artisan config:cache && php artisan route:cache && php artisan optimize && php artisan view:clear && composer dump-autoload"

key:
	docker exec api bash -c "php artisan key:generate"

fresh:
	docker exec api bash -c "php artisan migrate:fresh"

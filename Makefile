.PHONY: start stop restart server

start:
	docker stop imobiliaria
	docker stop mysql
	docker start imobiliaria
	docker start mysql
	make server
	@echo "Containers iniciados"

stop:
	docker stop imobiliaria
	docker stop mysql
	@echo "Containers parados com sucesso"

restart: stop start
	@echo "Containers reiniciados com sucesso."

server:
	docker exec -d imobiliaria bash -c "php artisan serve --host 0.0.0.0 --port=7000"
	docker exec -d imobiliaria bash -c "npm run dev -- --host"

migrate:
	docker exec imobiliaria bash -c "php artisan migrate"

seed:
	docker exec imobiliaria bash -c "php artisan db:seed"

cache:
	docker exec imobiliaria bash -c "php artisan config:cache && php artisan route:cache && php artisan optimize && php artisan view:clear && composer dump-autoload"

key:
	docker exec imobiliaria bash -c "php artisan key:generate"

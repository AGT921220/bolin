include .env

 example:
	@echo ${SERVER_PASS};
 up:
	@docker compose up -d;\

 down:
	@docker compose down;\

install:
	echo "Docker Exec";\
	sudo docker exec -it php-bolin composer install
enter:
	docker exec -it php-bolin /bin/bash;
qa-code-metrics:
	@php artisan qa;
test:
	@./vendor/bin/phpunit
hard-restore-db:
	@mysql -uroot -p${password} -e "drop database if exists agsoftwe_valuacion_iqinmobiliaria; create database agsoftwe_valuacion_iqinmobiliaria";\
	php artisan migrate;
	php artisan db:seed --class=DatabaseSeeder
restart-testing-db:
	@mysql -uroot -p${password} -e "drop database if exists agsoftwe_valuacion_iqinmobiliaria_testing; create database agsoftwe_valuacion_iqinmobiliaria_testing";\
	php artisan migrate --env=testing;
	php artisan db:seed --class=DatabaseSeeder --env=testing;

clear:
	@docker exec -it php-bolin /bin/bash -c "php artisan cache:clear && php artisan config:clear && php artisan horizon:purge && php artisan horizon:terminate && php artisan queue:restart"

qa/full-report:
	@mkdir -p build/phpmd && mkdir -p build/phpstan && mkdir -p build/phpcs && mkdir -p build/coverage-report &&\
	vendor/bin/phpunit --coverage-clover ./build/phpunit-sonarqube/coverage.xml --log-junit ./build/phpunit-sonarqube/logfile.xml \
	--coverage-html ./build/coverage-report && \
	phpdismod -s cli xdebug && \
	vendor/bin/phpmd app html phpmd.xml --reportfile build/phpmd/phpmd.html --ignore-violations-on-exit && \
	vendor/bin/phpcs --report=summary --report-file=./build/phpcs/phpcs_summary.txt --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1 app && \
	vendor/bin/phpcs --report=source --report-file=./build/phpcs/phpcs_source.txt --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1 app && \
	vendor/bin/phpcs --report=full --report-file=./build/phpcs/phpcs_full.txt --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1 app;

server-enter:
	@sshpass -p test ssh root@e73c1b9.online-server.cloud


coverage-report:
	@./vendor/bin/phpunit --coverage-html build/coverage-report
check-namespaces:
	@php artisan check_namespaces



configure-testing-database:
	@php artisan migrate --env="testing";

install-xdebug:
	@apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.9.2 \
    && docker-php-ext-enable xdebug
phpunit-config:
	@alias phpunit='./vendor/bin/phpunit';
ngrok:
	@ngrok http --host-header=rewrite http://localhost:8088;

create-valid-path:
	@mkdir -p storage/framework/cache \
	mkdir -p storage/framework/views

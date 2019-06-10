
cd `dirname $0`

git pull
git submodule update -i

## keep APP_KEY in .env file
## cp -af .env.example .env
cp -af env-dev-laradock laradock/.env

cd laradock
docker-compose up -d apache2 mysql phpmyadmin php-fpm

### open -a Firefox http://localhost
### open -a Firefox http://localhost:8080
### open -a Firefox http://localhost:3000

## docker-compose exec --user=laradock workspace npm install;npm run dev
docker-compose exec --user=laradock workspace bash

npm outdated
composer outdated
npm install
npm run dev
npm run watch

### php artisan migrate:refresh --step=1
### nohup php artisan queue:work --daemon &
### make model
###  php artisan make:model Modelname -m
###  php artisan make:controller XXXController --resource
###  php artisan cache:clear
###  php artisan config:clear
###  php artisan route:clear
###  php artisan view:clear
###  php artisan key:generate


###  php artisan route:list
###  phpunit --testdox

### heroku run php artisan migrate:refresh -a spaceneedles
### heroku run php artisan passport:install -a spaceneedles
### heroku run bash -a spaceneedles
### heroku logs --tail -a spaceneedles

# Aggro Weather API


## Description ##

### This is a weather forecast API built using the Laravel Framework.
#### The purpose of this API is to fetch temperature and precipitation weather data on a daily and hourly step. It has a job that is set to be running daily at 09:00. It currently contains 2 weather APIs by default ([METEO](https://open-meteo.com/) & [WEATHER API](https://www.weatherapi.com/)), but it is modular and can be used to support more APIs as well as any desirable locations.

###

## Prerequisites

- [ ] Docker
- [ ] Docker Compose

###

## Deployment

#### Open a terminal inside the project directory and run:

```
docker compose build
docker compose up
```

## Installation(Step by step) [OPTIONAL] 
#### After all the containers are up and running, inside the project directory copy the file ".env.dev" into a new ".env" file

#### Enter the php container terminal either by using the docker desktop GUI or by cli command
#### and run:

```
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate:refresh --seed
```

###

## Usage

#### You can view / create / update / delete:
- [ ] Your desired locations for which the weather forecast data will be fetched
- [ ] The remote APIs that will be used to fetch that data

#### You can do so by accessing the /location & /remote_api CRUD endpoints via POSTMAN or any other desired application.
#### Those endpoints can be accessed through http://localhost:8003/api/{entity}

The weather forecast job is set to be running daily at 09:00, but you can run it on demand by:
```
php artisan forecast:hourly-daily
```

By doing so the forecasts database table is populated with forecast entries containing the weather data, for each separate location, remote API and step. 

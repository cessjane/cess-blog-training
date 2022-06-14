# Training Local Setup

## Pre-requisites
* Docker
* Git

This docker configuration already contains the following images:
* Mysql 5.7
* PHP 7.3 w/ apache (with preinstalled depedencies)

1. Build docker images.
```
# docker-compose build
```
2. Place laravel code in this directory: `traning/apps/training`
3. Start docker.
```
# docker-compose up -d
```

## Accessing the Php-apache image
```
# docker-compose exec training bash
```

## Connecting to Mysql
Use the following configuration to connect to the mysql image:
Connection name: training
Connection method: tcp/ip
Hostname: 127.0.0.1
Port: 3306
Username: root
Password: admin


## Application Default URL
http://localhost:8080
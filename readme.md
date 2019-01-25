![Alt text](public/admin/img/logo.png?raw=true "Title")

## MindValley Task

### Prerequisites

* docker-compose

### Installation 
 
 1- clone the project
 
    $ git clone https://github.com/m-elkady/mindvalley
 
 2- copy the .env file 
 
    $ cp .env.example .env
 
 3- run docker compose to run the project
    
    $ docker-compose up
 
 4- run the docker container 
 
    $ docker exec -it php /bin/zsh
    
 5- install packages 
  
     $ composer install
  
 6- run migrations and seeders
  
     $ php artisan migrate
     $ php artisan db:seed
    
* Now you can preview the task from 

    [http://localhost](http://localhost) 

### Admin area url 

[http://localhost/admin](http://localhost/admin)

* username : admin
* password: 123456


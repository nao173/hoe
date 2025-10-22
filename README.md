# laravel-docker-template
# hoe
✔ php  Built

✔ Container hoe-mysql-1       Running                     
 ✔ Container hoe-phpmyadmin-1  Running                    
 ✔ Container hoe-php-1         St...                       
 ✔ Container hoe-nginx-1       Running

CONTAINER ID   IMAGE                   COMMAND                  CREATED              STATUS              PORTS                                     NAMES
8beec319e1e8   hoe-php                 "docker-php-entrypoi…"   About a minute ago   Up About a minute   9000/tcp                                  hoe-php-1
f85ad81ddae0   nginx:1.21.1            "/docker-entrypoint.…"   2 weeks ago          Up 14 minutes       0.0.0.0:80->80/tcp, [::]:80->80/tcp       hoe-nginx-1
b4cf1a16d283   phpmyadmin/phpmyadmin   "/docker-entrypoint.…"   2 weeks ago          Up 14 minutes       0.0.0.0:8080->80/tcp, [::]:8080->80/tcp   hoe-phpmyadmin-1
4dded64672b3   mysql:8.0.26            "docker-entrypoint.s…"   2 weeks ago          Up 14 minutes       3306/tcp, 33060/tcp                       hoe-mysql-1
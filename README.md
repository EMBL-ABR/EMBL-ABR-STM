# EMBL-ABR Search for Training Materials
EMBL-ABR STM (Search for Training Materials) is a web-based tool using a custom Google search engine to find bioinformatics training materials from various organisations both in Australia and worldwide.

EMBL-ABR STM is a tailored implementation from: BATMat: Bioinformatics Autodiscovery of Training Materials, Brief Bioinform (2015) doi: 10.1093/bib/bbv071


### Launch instructions

1. Install dependencies:
  ```
  sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
  sudo apt-get update
  sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y
  sudo apt-get -y install nginx
  sudo apt-get install git
  sudo service nginx start
  ```

2. Put php and html files into `/usr/share/nginx/html/`

3. Ensure all json and txt files are writable - these are generally used for logging
  ```
  chmod 777 limit.*
  chmod 777 *.json
  chmod 777 *.txt
  ```

4. Change the config files:

  - **/etc/nginx/sites-available/default**

     change `index index.html index.htm;`

     to `index index.html index.htm index.php;`

     then change the PHP section to:

      ```
      # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000

      location ~ \.php$ {
              fastcgi_split_path_info ^(.+\.php)(/.+)$;
              # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
              # With php5-cgi alone:
              fastcgi_pass 127.0.0.1:9000;

              # With php5-fpm:
              fastcgi_index index.php;
              include fastcgi_params;
      }
      ```

  - **/etc/php/7.0/fpm/php.ini**

    set `cgi.fix_pathinfo=0`

  - **/etc/php/7.0/fpm/pool.d/www.conf**

      change the listen line to `listen = 127.0.0.1:9000`

5. Then, reload all services

  ```
  service php7.0-fpm reload
  sudo service nginx restart
  ```

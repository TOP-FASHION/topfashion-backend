# Docker-based WordPress Stack

[![Build Status](https://travis-ci.org/wodby/docker4wordpress.svg?branch=master)](https://travis-ci.org/wodby/docker4wordpress)

## Introduction

Docker4WordPress is a set of docker images optimized for WordPress. Use docker-compose.yml file from this repository to spin up a local environment for WordPress on Linux, macOS and Windows. 

* Read the docs on [**how to use**](https://wodby.com/docs/stacks/wordpress/local#usage)
* Join our community on [Spectrum](https://spectrum.chat/wodby/wordpress) and ask questions in `#WordPress` channel
* Follow [@wodbycloud](https://twitter.com/wodbycloud) for future announcements

## Stack

The WordPress stack consist of the following containers:

| Container       | Versions                | Service name    | Image                              | Default |
| -------------   | ----------------------- | ------------    | ---------------------------------- | ------- |
| [Nginx]         | 1.17, 1.16              | `nginx`         | [wodby/nginx]                      | ✓       |
| [Apache]        | 2.4                     | `apache`        | [wodby/apache]                     |         |
| [WordPress]     | 5                       | `php`           | [wodby/wordpress]                  | ✓       |
| [PHP]           | 7.3, 7.2, 7.1, 5.6      | `php`           | [wodby/wordpress-php]              |         |
| [MariaDB]       | 10.4, 10.3, 10.2, 10.1  | `mariadb`       | [wodby/mariadb]                    | ✓       |
| [PostgreSQL]    | 11, 10, 9.x             | `postgres`      | [wodby/postgres]                   |         |
| [Redis]         | 5, 4                    | `redis`         | [wodby/redis]                      |         |
| [Memcached]     | 1                       | `memcached`     | [wodby/memcached]                  |         |
| [Varnish]       | 6.0, 4.1                | `varnish`       | [wodby/varnish]                    |         |
| [Node.js]       | 12, 10, 8               | `node`          | [wodby/node]                       |         |
| [Solr]          | 8, 7, 6, 5              | `solr`          | [wodby/solr]                       |         |
| [Elasticsearch] | 7, 6                    | `elasticsearch` | [wodby/elasticsearch]              |         |
| [Kibana]        | 7, 6                    | `kibana`        | [wodby/kibana]                     |         |
| [AthenaPDF]     | 2.10.0                  | `athenapdf`     | [arachnysdocker/athenapdf-service] |         |
| [Mailhog]       | latest                  | `mailhog`       | [mailhog/mailhog]                  | ✓       |
| [OpenSMTPD]     | 6.0                     | `opensmtpd`     | [wodby/opensmtpd]                  |         |
| [Rsyslog]       | latest                  | `rsyslog`       | [wodby/rsyslog]                    |         |
| [Blackfire]     | latest                  | `blackfire`     | [blackfire/blackfire]              |         |
| [Webgrind]      | 1.5                     | `webgrind`      | [wodby/webgrind]                   |         |
| [XHProf viewer] | latest                  | `xhprof`        | [wodby/xhprof]                     |         |
| Adminer         | 4.6                     | `pma`           | [wodby/adminer]                    |         |
| phpMyAdmin      | latest                  | `pma`           | [phpmyadmin/phpmyadmin]            |         |
| Portainer       | latest                  | `portainer`     | [portainer/portainer]              | ✓       |
| Traefik         | latest                  | `traefik`       | [_/traefik]                        | ✓       |

Supported WordPress versions: 5


## Documentation

Full documentation is available at https://wodby.com/docs/stacks/wordpress/local.


## License

This project is licensed under the MIT open source license.

[Apache]: https://wodby.com/docs/stacks/wordpress/containers#apache
[AthenaPDF]: https://wodby.com/docs/stacks/wordpress/containers#athenapdf
[Blackfire]: https://wodby.com/docs/stacks/wordpress/containers#blackfire
[Elasticsearch]: https://wodby.com/docs/stacks/elasticsearch
[Kibana]: https://wodby.com/docs/stacks/elasticsearch
[Mailhog]: https://wodby.com/docs/stacks/wordpress/containers#mailhog
[MariaDB]: https://wodby.com/docs/stacks/wordpress/containers#mariadb
[Memcached]: https://wodby.com/docs/stacks/wordpress/containers#memcached
[Nginx]: https://wodby.com/docs/stacks/wordpress/containers#nginx
[Node.js]: https://wodby.com/docs/stacks/wordpress/containers#nodejs
[OpenSMTPD]: https://wodby.com/docs/stacks/wordpress/containers#opensmtpd
[PHP]: https://wodby.com/docs/stacks/wordpress/containers#php
[PostgreSQL]: https://wodby.com/docs/stacks/wordpress/containers#postgresql
[Redis]: https://wodby.com/docs/stacks/wordpress/containers#redis
[Rsyslog]: https://wodby.com/docs/stacks/wordpress/containers#rsyslog
[Solr]: https://wodby.com/docs/stacks/solr
[Varnish]: https://wodby.com/docs/stacks/wordpress/containers#varnish
[Webgrind]: https://wodby.com/docs/stacks/wordpress/containers#webgrind
[Wordpress]: https://wodby.com/docs/stacks/wordpress/containers#php
[XHProf viewer]: https://wodby.com/docs/stacks/php/containers#xhprof-viewer

[_/traefik]: https://hub.docker.com/_/traefik
[arachnysdocker/athenapdf-service]: https://hub.docker.com/r/arachnysdocker/athenapdf-service
[blackfire/blackfire]: https://hub.docker.com/r/blackfire/blackfire
[mailhog/mailhog]: https://hub.docker.com/r/mailhog/mailhog
[phpmyadmin/phpmyadmin]: https://hub.docker.com/r/phpmyadmin/phpmyadmin
[portainer/portainer]: https://hub.docker.com/r/portainer/portainer
[wodby/adminer]: https://github.com/wodby/adminer
[wodby/apache]: https://github.com/wodby/apache
[wodby/elasticsearch]: https://github.com/wodby/elasticsearch
[wodby/kibana]: https://github.com/wodby/kibana
[wodby/mariadb]: https://github.com/wodby/mariadb
[wodby/memcached]: https://github.com/wodby/memcached
[wodby/nginx]: https://github.com/wodby/nginx
[wodby/node]: https://github.com/wodby/node
[wodby/opensmtpd]: https://github.com/wodby/opensmtpd
[wodby/postgres]: https://github.com/wodby/postgres
[wodby/redis]: https://github.com/wodby/redis
[wodby/rsyslog]: https://github.com/wodby/rsyslog
[wodby/solr]: https://github.com/wodby/solr
[wodby/varnish]: https://github.com/wodby/varnish
[wodby/webgrind]: https://hub.docker.com/r/wodby/webgrind
[wodby/wordpress-php]: https://github.com/wodby/wordpress-php
[wodby/wordpress]: https://github.com/wodby/wordpress
[wodby/xhprof]: https://github.com/wodby/xhprof



# mariadb-init

This folder is only used when this project is run in a Docker container with Docker-Compose. 

Any .sql files in this directory will be automatically executed by the database when the mariadb container is created. These can include database dumps and/or sql queries or commands needed on startup.

Once created, data in the container will persist even when the container is stopped or shut down, as long as this volume is not removed.

The container will afterward ignore the files in this folder. Changing or updating these files later will have no effect on the database in the running container.

To relaunch the container with new or updated .sql files, shut the container down **and remove its volumes**, then start it again, i.e.

```
docker-compose down -v
docker-compose up
```
If there are no .sql files in this folder, no action will be taken when the container is built.

Exporting a specific database:
```
docker-compose exec mariadb sh -c 'exec mysqldump -uroot -p"password" my-db' > my-db.sql
docker-compose exec mariadb sh -c 'exec mysqldump --all-databases -uroot -p"password"' > databases.sql

```

# Environment variables

* nginx/apache - [https://wp.docker.localhost:443](https://wp.docker.localhost:443)
* pma - [https://pma.wp.docker.localhost:443](https://pma.wp.docker.localhost:443)
* adminer - [https://adminer.wp.docker.localhost:443](https://adminer.wp.docker.localhost:443)
* mailhog	- [https://mailhog.wp.docker.localhost:443](https://mailhog.wp.docker.localhost:443)
* varnish	- [https://varnish.wp.docker.localhost:443](https://varnish.wp.docker.localhost:443)
* portainer - [https://portainer.wp.docker.localhost:443](https://portainer.wp.docker.localhost:443)
* webgrind - [https://webgrind.wp.docker.localhost:443](https://webgrind.wp.docker.localhost:443)

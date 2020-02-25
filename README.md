# Docker-based WordPress Stack

## Introduction

Docker4WordPress is a set of docker images optimized for WordPress. Use docker-compose.yml file from this repository to spin up a local environment for WordPress on Linux, macOS and Windows. 

* Read the docs on [**how to use**](https://wodby.com/docs/stacks/wordpress/local#usage)

## Stack

The WordPress stack consist of the following containers:

| Container       | Versions                | Service name    | Image                              | Default |
| -------------   | ----------------------- | ------------    | ---------------------------------- | ------- |
| [Nginx]         | 1.17, 1.16              | `nginx`         | [wodby/nginx]                      | ✓       |
| [WordPress]     | 5                       | `php`           | [wodby/wordpress]                  | ✓       |
| [MariaDB]       | 10.4, 10.3, 10.2, 10.1  | `mariadb`       | [wodby/mariadb]                    | ✓       |
| phpMyAdmin      | latest                  | `pma`           | [phpmyadmin/phpmyadmin]            | ✓       |
| Portainer       | latest                  | `portainer`     | [portainer/portainer]              | ✓       |
| Traefik         | latest                  | `traefik`       | [_/traefik]                        | ✓       |

Supported WordPress versions: 5


## Documentation

Full documentation is available at https://wodby.com/docs/stacks/wordpress/local.


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

* traefik - [https://traefik.docker.localhost:443](https://traefik.docker.localhost:443)
* nginx - [https://docker.localhost:443](https://docker.localhost:443)
* pma - [https://pma.docker.localhost:443](https://pma.docker.localhost:443)
* portainer - [https://portainer.docker.localhost:443](https://portainer.docker.localhost:443)


## License

This project is licensed under the MIT open source license.

[MariaDB]: https://wodby.com/docs/stacks/wordpress/containers#mariadb
[Nginx]: https://wodby.com/docs/stacks/wordpress/containers#nginx
[Wordpress]: https://wodby.com/docs/stacks/wordpress/containers#php
[_/traefik]: https://hub.docker.com/_/traefik
[phpmyadmin/phpmyadmin]: https://hub.docker.com/r/phpmyadmin/phpmyadmin
[portainer/portainer]: https://hub.docker.com/r/portainer/portainer
[wodby/nginx]: https://github.com/wodby/nginx
[wodby/adminer]: https://github.com/wodby/adminer
[wodby/mariadb]: https://github.com/wodby/mariadb
[wodby/wordpress]: https://github.com/wodby/wordpress

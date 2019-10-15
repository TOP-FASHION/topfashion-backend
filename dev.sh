#!/bin/bash

comando=$1

if [ $comando = "ps" ]; then

    docker-compose  ps
fi

if [ $comando = "up" ]; then

    docker-compose  -f docker-compose.yml -f docker-compose-dev.yml up -d
fi

if [ $comando = "stop" ]; then

    docker-compose  stop
fi

if [ $comando = "restart" ]; then

    docker-compose  stop
    docker-compose  -f docker-compose.yml -f docker-compose-dev.yml up -d
fi

if [ $comando = "down" ]; then

    docker-compose -f docker-compose.yml -f docker-compose-dev.yml down

fi

if [ $comando = "pull" ]; then

    docker-compose pull
fi


if [ $comando = "exec" ]; then

    docker-compose  exec php /bin/bash
fi

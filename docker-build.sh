#!/bin/bash

# param 1: env
# param 2: name
# param 3: tag
# EXAMPLE:
# ./docker-build.sh stage mysite 4.9.5-1.0

# param 1
if [ "$1" != "" ]; then

    env=$1
else
    echo "Enter the environment, e.g., s, stage, p, prod"
    read -p 'env: ' env
fi

# lcase using tr
env="$(echo $env | tr '[A-Z]' '[a-z]')"

# set env to prod or stage
case "$env" in
    "prod")
        env=$env
        ;;
    "stage")
        env=$env
        ;;
    "p")
        env=$env"rod"
        ;;
    "s")
        env=$env"tage"
        ;;
esac

# param 2
if [ "$2" != "" ]; then

    name=$2
else
    echo "Enter the name of the image, e.g., mysite"
    read -p 'name: ' name
fi

# param 3
if [ "$3" != "" ]; then

    tag=$3
else
    echo "Enter the image tag, e.g., 4.9.5-1.0"
    read -p 'tag: ' tag
fi

# image
image=$name":"$tag

function build {

    SRC="wordpress"
    BUILD="build"
    THEME="mytheme"

    # cleanup
    rm -rf $BUILD

    # docker folders
    mkdir -p docker/prod
    mkdir -p docker/stage

    # build folders
    mkdir -p $BUILD/wp-content/themes

    if [ -d $SRC/wp-content/plugins ]; then
        cp -r $SRC/wp-content/plugins $BUILD/wp-content/plugins
    fi
    if [ -d $SRC/wp-content/themes ]; then
        cp -r $SRC/wp-content/themes/$THEME $BUILD/wp-content/themes/$THEME
    fi
    if [ -d $SRC/wp-content/uploads ]; then
        cp -r $SRC/wp-content/uploads $BUILD/wp-content/uploads
    fi

    # files
    if [ -e $SRC/.htaccess ]; then
        cp $SRC/.htaccess $BUILD/.htaccess
    fi

    for i in $SRC/*.html; do cp $i $BUILD; done
    for i in $SRC/*.txt; do cp $i $BUILD; done
    for i in $SRC/*.xml; do cp $i $BUILD; done

    ## files (prod)
    # if [ "$env" == "prod" ]; then
    #     if [ -e $SRC/wp-content/themes/$THEME/footer_prod.php ]
    #         cp $SRC/wp-content/themes/$THEME/footer_prod.php $BUILD/wp-content/themes/$THEME/footer.php
    #         echo "prod footer cp"
    #     fi
    # fi

    # build docker image
    docker build --squash -f Dockerfile -t $image .

    # replace colon with hyphen on $TAG for filename
    TAR=${image//:/-}

    # save image
    docker save -o docker/$env/$TAR.tar $image
}

# ucase using tr
envu="$(echo $env | tr '[a-z]' '[A-Z]')"

# confirm
read -p "Build $envu Docker image: $image ? [y/n] " CONT
case "$CONT" in
    y|Y )
        build
        ;;
    * )
        exit 0
        ;;
esac

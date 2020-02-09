#!/bin/bash
source env.sh
docker rm -f trece 2>/dev/null
run_container () {
    docker run -d \
    -e SITE_SCHEME=$SITE_SCHEME \
    -p $PORT:80 \
    -v "$(pwd)"/htdocs:/var/www/html:z \
    --name $CONTAINER_NAME $DOCKER_IMAGE
}
if [ ! -d "htdocs" ]; then
    mkdir htdocs
    cp .htaccess htdocs
    cp ../LICENSE htdocs
    cp ../README.md htdocs
    cp ../index.php htdocs
    cp ../firsttime.php htdocs
    cp -r ../trece htdocs
    cp -r ../themes htdocs
    cp -r ../css htdocs
    cp -r ../js htdocs
    cp -r ../img htdocs
fi
run_container

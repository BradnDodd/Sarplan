#!/bin/sh

set -e
echo "DEV ENTRY POINT"
# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- apache2-foreground "$@"
fi

# FILE=/var/www/.env
# if [ ! -f "$FILE" ]; then
#     echo "COPYING DEV ENV"
#     cp -n .env_example .env;
# fi

# echo "COMPOSER INSTALL"
# composer install;

exec "$@"

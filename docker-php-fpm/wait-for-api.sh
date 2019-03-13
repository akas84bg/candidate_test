#!/bin/bash


cmd="$@"


cd /var/www/v4-codebase


if [ -z $DB_HOST ]; then
    export $(grep -v '^#' .env | xargs)
fi

if [ "$APP_ENV" == "development-ecosystem" ]; then


    check_api_ok () {
	curl $API_BASE_URL -v 2>&1 | grep "200 OK" | wc -l
    }
    
    echo "++++++++++++++++++++++++ CHECKING API +++++++++++++++++++++++++++++++++++++++"
    RETRIES=200;
    COUNT=0;

    connected=$(check_api_ok);
    while  [ "$connected" == "0" ] && [ $COUNT -lt $RETRIES ];
    do
        connected=$(check_api_ok);
        sleep 1;
        COUNT=$((COUNT+1))
    done 
    
    if [ $COUNT -eq $RETRIES ];
    then
        echo "API is not OK"
        exit 1;
    fi
    
    echo "API OK"

fi

exec $@


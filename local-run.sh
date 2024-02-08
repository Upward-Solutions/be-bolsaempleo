#!/bin/bash

if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    docker-compose up
elif [[ "$OSTYPE" == "msys"* || "$OSTYPE" == "cygwin" ]]; then
    winpty docker-compose up
else
    echo "Sistema operativo no soportado"
    exit 1
fi

#!/bin/bash

# Verifica el sistema operativo
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    # Sistema operativo Linux
    docker-compose up
elif [[ "$OSTYPE" == "msys"* || "$OSTYPE" == "cygwin" ]]; then
    # Sistema operativo Windows
    winpty docker-compose up
else
    # Otros sistemas operativos (no soportados)
    echo "Sistema operativo no soportado"
    exit 1
fi

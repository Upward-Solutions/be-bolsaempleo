#!/bin/bash

docker_compose_installed=$(command -v docker-compose)

if [[ -n "$docker_compose_installed" ]]; then
    echo "Docker Compose está instalado en la ruta: $docker_compose_installed"
    compose_version=$("$docker_compose_installed" --version | awk '{print $3}')
    echo "La versión de Docker Compose instalada es: $compose_version"

    if [[ "$OSTYPE" == "linux-gnu"* && $(echo "$compose_version" | cut -d '.' -f 1) -ge 2 ]]; then
        echo "Se utilizará 'docker compose up' en Linux."
        docker compose up
    else
        echo "Se utilizará 'docker-compose up'."
        docker-compose up
    fi
elif [[ "$OSTYPE" == "msys"* || "$OSTYPE" == "cygwin" ]]; then
    echo "Docker Compose no está instalado."
    echo "Ejecutando 'winpty docker-compose up'..."
    winpty docker-compose up
else
    echo "Docker Compose no está instalado o no se encuentra en la ruta."
    echo "Por favor, instala Docker Compose y vuelve a intentarlo."
    exit 1
fi

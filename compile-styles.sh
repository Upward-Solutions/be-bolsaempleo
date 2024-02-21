#!/bin/bash

command -v node >/dev/null 2>&1

node_installed=$?

command -v sass >/dev/null 2>&1

sass_installed=$?

if [[ $node_installed -ne 0 || $sass_installed -ne 0 ]]; then
    echo "Antes de ejecutar este script, tenés que ejecutar el archivo setup.sh"
    exit 1
fi

sass -w ./core/styles/sass/index.scss ./core/styles/css/index.css
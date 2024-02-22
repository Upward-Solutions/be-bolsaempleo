#!/bin/bash

carpeta="uploads"
total_steps=6
current_step=0

print_progress() {
    local progress=$((100 * current_step / total_steps))
    local completed
    local remaining
    local progress_bar
    local empty_bar
    completed=$((progress / 2))
    remaining=$((50 - completed))
    progress_bar=$(printf "%-${completed}s" | tr ' ' '=')
    empty_bar=$(printf "%-${remaining}s")
    echo -ne "[$progress_bar$empty_bar] $progress%\r"
}

install_node() {
    echo "Instalando Node.js..."
  if [[ "$(uname)" == "Linux" ]]; then
      echo "Instalando Node.js en Linux..."
      sudo apt-get install nodejs
  elif [[ "$(uname)" == "Darwin" ]]; then
      echo "Instalando Node.js en macOS..."
      brew install node
  fi
}

check_and_install_npm() {
    if command -v npm >/dev/null 2>&1; then
        echo -n "npm está instalado. Versión "
        npm --version | tr -d '\n'
        echo ""
    else
        echo "npm no está instalado en este sistema."
        if [[ "$OSTYPE" == "msys" ]]; then
            echo "Por favor, instale npm desde https://www.npmjs.com/get-npm"
            echo "No se puede continuar, por favor instala npm."
            exit 1
        else
            install_npm
        fi
    fi
}

install_npm() {
    echo "Instalando npm..."
    if [[ "$(uname)" == "Linux" ]]; then
        echo "Instalando npm en Linux..."
        sudo apt-get install npm
    elif [[ "$(uname)" == "Darwin" ]]; then
        echo "Instalando npm en macOS..."
        brew install npm
    fi
}

echo 'Configurando el proyecto'

echo '1) Borrando carpeta ./uploads'
if [[ "$(uname)" == "Darwin" ]]; then
    rm -rf "$carpeta"
else
    rm -r "$carpeta"
fi
((current_step++))
print_progress
echo

echo '2) Creando nueva carpeta ./uploads'
mkdir "$carpeta"
((current_step++))
print_progress
echo

echo '3) Asignando permisos a la carpeta ./uploads'
if [[ "$(uname)" != "Darwin" ]]; then
    chmod -R 0777 "$carpeta"
fi
((current_step++))
print_progress
echo

echo '4) Verificando versión de Node.js'
if command -v node >/dev/null 2>&1; then
    echo -n "Node.js está instalado. Versión "
    node --version | tr -d '\n'
    echo ""
else
    echo "Node.js no está instalado en este sistema."
        if [[ "$OSTYPE" == "msys" ]]; then
            echo "Por favor, instale Node.js desde https://nodejs.org/"
            echo "No se puede continuar, por favor instala Node.js."
            exit 1
        else
            install_node
        fi
fi
((current_step++))
print_progress
echo

echo '5) Verificando versión de npm'
check_and_install_npm
((current_step++))
print_progress
echo

echo '6) Verificando versión de Sass'
command -v sass >/dev/null 2>&1

sass_installed=$?

if [[ $sass_installed -eq 0 ]]; then
    echo -n "Sass está instalado. Versión "
    sass --version | awk '{print $2}' | tr -d '\n'
    echo ""
else
  echo "Sass no está instalado en este sistema."
  npm install -g sass
fi
((current_step++))
print_progress
echo

# setup php
# sudo apt-get install php-xml
# sudo apt-get install php-curl
# composer dump-autoload

echo 'DONE'

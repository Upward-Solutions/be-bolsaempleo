#!/bin/bash

carpeta="uploads"
total_steps=3
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

echo 'DONE'

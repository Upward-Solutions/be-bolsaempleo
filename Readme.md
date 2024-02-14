# Setup - primera vez
1. Dar permisos al archivo (Solo para usuarios linux)
    ```bash
        sudo chmod +x setup.sh
    ```
2. Ejecutar archivo
    ```bash
        ./stup.sh
    ```

# Levantar localmente la aplicación

## Prerrequisitos

Antes de ejecutar el script, asegúrate de cumplir con los siguientes prerrequisitos:

- **Docker:**
   - Asegúrate de tener Docker instalado en tu sistema. Puedes descargar Docker desde [la página oficial de Docker](https://docs.docker.com/get-docker/).

      - Para sistemas **Linux**, sigue las instrucciones de instalación [aquí](https://docs.docker.com/get-docker/).
      - Para sistemas **Windows**, sigue las instrucciones de instalación [aquí](https://docs.docker.com/desktop/install/windows/).

- **Docker Compose:**
   - También necesitarás tener Docker Compose instalado. Puedes obtener Docker Compose como parte de la instalación de Docker.

      - Para sistemas **Linux**, sigue las instrucciones de instalación [aquí](https://docs.docker.com/compose/install/).
      - Para sistemas **Windows**, Docker Compose se instala automáticamente junto con Docker Desktop.

Asegúrate de que ambos estén instalados y correctamente configurados antes de ejecutar el script `local-run.sh`.


## Acciones

1. Ejecutar el archivo para levantar los dos docker

   ```bash
      ./local-run.sh
   ```

2. Abrir la aplicación en la siguiente [url](localhost:8080)


# Ejecución de local-run.sh

Este archivo README proporciona instrucciones para ejecutar el script `local-run.sh` en sistemas Windows y Linux.

## Windows (PowerShell)

1. **Requisitos previos:**
   - Asegúrate de tener PowerShell instalado en tu sistema.

2. **Pasos:**
   - Abre una terminal de PowerShell.
   - Navega al directorio donde se encuentra el script `local-run.sh`.
   - Ejecuta el siguiente comando:

     ```powershell
     .\local-run.sh
     ```

   - Si aparece un mensaje sobre la ejecución de scripts restringidos, puedes necesitar habilitar la ejecución de scripts. Ejecuta el siguiente comando para permitir la ejecución de scripts no firmados:

     ```powershell
     Set-ExecutionPolicy Unrestricted -Scope CurrentUser
     ```

   - Vuelve a intentar ejecutar el script.

## Linux

1. **Requisitos previos:**
   - Asegúrate de tener permisos de ejecución para el script. Si no los tienes, puedes otorgarlos con el siguiente comando:

     ```bash
     chmod +x local-run.sh
     ```

2. **Pasos:**
   - Abre una terminal.
   - Navega al directorio donde se encuentra el script `local-run.sh`.
   - Ejecuta el siguiente comando:

     ```bash
     ./local-run.sh
     ```

   - Si obtienes un error sobre permisos, asegúrate de haber otorgado los permisos de ejecución.
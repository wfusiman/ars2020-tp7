# ARQUITECTURA DE REDES Y SERVICIOS - 2020 
## RESOLUCION TRABAJO PRACTICO 7
## API REST: servidor nodejs y cliente PHP 

1. Implementacion de servidor node.js, con autenticacion mediante tokens.

- Despliegue \
En la carpeta Server ejecutar node index.js

2. Implentacion cliente PHP con API de servidor node.js: maneja un numero indeterminado de usuarios.

- Despliegue \
Copiar la carpeta client en el directorio htdocs de la instalacion de Xampp. Ejecutar el servidor web Apache.
Una vez iniciado acceder mediante el browser a la url:
http://localhost:80/usuarios 

Inicialmente se requiere la autenticacion de un usuario administrador mediante la pantalla de login.
Los administradores habilitados se encuentran en el server en el archivo /configs/admins.js
Mediante este cliente PHP se pueden realizar operaciones sobre usuarios: listar, buscar, crear, modificar y eliminar.

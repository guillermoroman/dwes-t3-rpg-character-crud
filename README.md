CRUD de personajes de juego de Rol

### Objetivos:
- Guardar personaje en BD.
- Leer personajes de la base de datos.
- Editar personajes.
- Borrar personajes.

Atributos para un personaje:
- name
- description
- helth
- strength
- defensa

```SQL
CREATE TABLE `characters` (
    `id` INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único
    `name` VARCHAR(255) NOT NULL, -- Nombre del personaje
    `description` TEXT, -- Descripción del personaje
    `health` INT NOT NULL, -- Puntos de vida
    `strength` INT NOT NULL, -- Fuerza del personaje
    `defense` INT NOT NULL, -- Defensa del personaje
    `image` VARCHAR(255), -- Ruta o URL de la imagen
    `user_id` INT, -- Relación con un usuario puede ser NOT NULL una vez implementado el inicio de sesión
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE -- Relación con la tabla de usuarios
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
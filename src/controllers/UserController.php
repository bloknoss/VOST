<?php
namespace VOST\controllers;

class UserController {
    public int $pepe;
    public function __construct(int $num = 5)
    {
        $this->pepe = $num;
    }

    public function printHola() {
        // Lógica para obtener todos los usuarios
        echo 'Obtener todos los usuarios';
    }

    public function show($id) {
        // Lógica para obtener un usuario por ID
        echo "Obtener usuario con ID: $id";
    }

    public function store() {
        // Lógica para crear un nuevo usuario
        echo 'Crear un nuevo usuario';
    }

    public function update($id) {
        // Lógica para actualizar un usuario por ID
        echo "Actualizar usuario con ID: $id";
    }

    public function destroy($id) {
        // Lógica para eliminar un usuario por ID
        echo "Eliminar usuario con ID: $id";
    }

}
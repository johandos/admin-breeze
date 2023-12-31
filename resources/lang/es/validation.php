<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'unique' => 'El campo :attribute ya existe.',
    'regex' => 'El campo :attribute no es valido.',
    'confirmed' => 'El campo :attribute no coincide con la confirmacion.',
    'string'   => 'El campo :attribute debe ser una cadena de texto.',
    'failed' => 'Credenciales no válidas',
    'throttle' => 'Demasiados intentos de inicio de sesión. Por favor, intente de nuevo en :minutes minutos.',
    'min'      => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max'      => [
        'string' => 'El campo :attribute no debe exceder :max caracteres.',
    ],
    'not_regex' => 'El campo :attribute no debe contener números.',
    'attributes' => [
        'name' => 'nombre',
        'surname' => 'apellido',
        'dni' => 'DNI',
        'email' => 'correo electrónico',
        'phone' => 'teléfono',
        'country' => 'país',
        'iban' => 'IBAN',
        'about' => 'acerca de',
        'password' => 'contraseña',
        'description' => 'descripcion',
        'reference' => 'descripcion',
    ],
];

<?php
return [
    '~^$~' => [\Moguta\Controllers\MainController::class, 'main'],
    '~^json$~' => [\Moguta\Controllers\MainController::class, 'json'],
    '~^json-like$~' => [\Moguta\Controllers\MainController::class, 'jsonlike'],
];
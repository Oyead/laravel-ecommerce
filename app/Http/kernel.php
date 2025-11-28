<?php
protected $middlewareGroups = [
    'web' => [
        // ... other middleware
        \App\Http\Middleware\SetLocale::class, // <-- Add this line
    ],
    // ...
];
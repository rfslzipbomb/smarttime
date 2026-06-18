<?php
$conn->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    foto TEXT NOT NULL, -- <--- Nueva columna para almacenar la ruta del archivo
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");
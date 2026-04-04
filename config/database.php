<?php 

    function loadEnv() {
        $path = __DIR__ . '/../.env';

        if (!file_exists($path)) {
            die("Error: no se encontró el archivo .env");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // NO COMENTARIOS
            if (str_starts_with(trim($line), '#')) continue;

            // SEPARA
            [$key, $value] = explode('=', $line, 2);

            $key   = trim($key);
            $value = trim($value);

            // ESTABLECE LA VARIABLE DE ENTORNO
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }

    function connectDB() {
        loadEnv();

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $port = getenv('DB_PORT');
        
        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage() . " Host: $host, Port: $port, DB: $dbname, User: $user");
        }

        return $pdo;
    }

?>
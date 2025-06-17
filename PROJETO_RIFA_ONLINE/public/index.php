<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rifas Online</title>
</head>
<body>
  <h1>Bem-vindo ao Sistema de Rifas Online</h1>
  <p>Configure o frontend aqui.</p>
</body>
</html>


// =====================
// 4. Procfile (caso use Render.com ou Heroku)
// =====================
web: node backend/app.js


// =====================
// 5. database.sql (exemplo básico do banco, importe via phpMyAdmin)
// =====================
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rifas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  price DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bilhetes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  rifa_id INT,
  number INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (rifa_id) REFERENCES rifas(id)
);

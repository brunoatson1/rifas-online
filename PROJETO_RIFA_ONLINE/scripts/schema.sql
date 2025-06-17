-- Criação da tabela rifas
CREATE TABLE IF NOT EXISTS rifas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  descricao TEXT,
  preco DECIMAL(10, 2) NOT NULL,
  total_numeros INT NOT NULL,
  data_sorteio DATE,
  imagem VARCHAR(255),
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela bilhetes
CREATE TABLE IF NOT EXISTS bilhetes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rifa_id INT NOT NULL,
  numero INT NOT NULL,
  nome_comprador VARCHAR(100),
  telefone VARCHAR(20),
  status ENUM('pendente', 'pago') DEFAULT 'pendente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (rifa_id) REFERENCES rifas(id) ON DELETE CASCADE
);

-- (Opcional) Criação da tabela de usuários
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('admin', 'loja') DEFAULT 'admin',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

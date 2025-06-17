const db = require('../config/database');

// Criar novo bilhete
async function create({ rifa_id, numero, nome_comprador, telefone }) {
  const [result] = await db.query(
    'INSERT INTO bilhetes (rifa_id, numero, nome_comprador, telefone, status) VALUES (?, ?, ?, ?, ?)',
    [rifa_id, numero, nome_comprador, telefone, 'pendente']
  );
  return result.insertId;
}

// Buscar todos os bilhetes de uma rifa
async function getByRifaId(rifaId) {
  const [rows] = await db.query(
    'SELECT * FROM bilhetes WHERE rifa_id = ? ORDER BY numero',
    [rifaId]
  );
  return rows;
}

// Listar todos os bilhetes
async function getAll() {
  const [rows] = await db.query('SELECT * FROM bilhetes ORDER BY id DESC');
  return rows;
}

// Verificar se o número já foi vendido
async function verificarDisponibilidade(rifa_id, numero) {
  const [rows] = await db.query(
    'SELECT * FROM bilhetes WHERE rifa_id = ? AND numero = ?',
    [rifa_id, numero]
  );
  return rows.length === 0;
}

// Marcar bilhete como pago (usado pelo webhook)
async function marcarComoPago(id) {
  await db.query(
    'UPDATE bilhetes SET status = ? WHERE id = ?',
    ['pago', id]
  );
}

module.exports = {
  create,
  getByRifaId,
  getAll,
  verificarDisponibilidade,
  marcarComoPago,
};

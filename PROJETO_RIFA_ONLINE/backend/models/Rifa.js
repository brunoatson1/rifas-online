const db = require('../config/database');

const Rifa = {
  async getAll() {
    const [rows] = await db.query('SELECT * FROM rifas');
    return rows;
  },

  async getById(id) {
    const [rows] = await db.query('SELECT * FROM rifas WHERE id = ?', [id]);
    return rows[0];
  },

  async create(data) {
    const { titulo, descricao, preco, imagem } = data;
    const [result] = await db.query(
      'INSERT INTO rifas (titulo, descricao, preco, imagem) VALUES (?, ?, ?, ?)',
      [titulo, descricao, preco, imagem]
    );
    return result.insertId;
  },
};

module.exports = Rifa;

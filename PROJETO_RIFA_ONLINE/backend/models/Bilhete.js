const db = require('../config/database');

const Bilhete = {
  async getByRifaId(rifa_id) {
    const [rows] = await db.query(
      'SELECT * FROM bilhetes WHERE rifa_id = ?',
      [rifa_id]
    );
    return rows;
  },

  async create(data) {
    const { rifa_id, numero, nome_comprador, telefone } = data;
    const [result] = await db.query(
      'INSERT INTO bilhetes (rifa_id, numero, nome_comprador, telefone) VALUES (?, ?, ?, ?)',
      [rifa_id, numero, nome_comprador, telefone]
    );
    return result.insertId;
  }
};

module.exports = Bilhete;

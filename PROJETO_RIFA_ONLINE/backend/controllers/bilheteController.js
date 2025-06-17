const Bilhete = require('../models/Bilhete');

module.exports = {
  // Criar novo bilhete (compra)
  async criarBilhete(req, res) {
    try {
      const { rifa_id, numero, nome_comprador, telefone } = req.body;

      // Verificar se número já foi vendido
      const disponivel = await Bilhete.verificarDisponibilidade(rifa_id, numero);
      if (!disponivel) {
        return res.status(400).json({ erro: 'Número já vendido para essa rifa' });
      }

      const id = await Bilhete.create({ rifa_id, numero, nome_comprador, telefone });
      res.status(201).json({ id, mensagem: 'Bilhete criado com sucesso!' });
    } catch (err) {
      console.error('Erro ao criar bilhete:', err);
      res.status(500).json({ erro: 'Erro interno ao criar bilhete' });
    }
  },

  // Listar bilhetes de uma rifa específica
  async listarPorRifa(req, res) {
    try {
      const bilhetes = await Bilhete.getByRifaId(req.params.rifaId);
      res.json(bilhetes);
    } catch (err) {
      console.error('Erro ao buscar bilhetes:', err);
      res.status(500).json({ erro: 'Erro ao buscar bilhetes' });
    }
  },

  // (Opcional) Listar todos os bilhetes do sistema
  async listarTodos(req, res) {
    try {
      const bilhetes = await Bilhete.getAll();
      res.json(bilhetes);
    } catch (err) {
      console.error('Erro ao listar bilhetes:', err);
      res.status(500).json({ erro: 'Erro ao listar bilhetes' });
    }
  }
};

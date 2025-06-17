const Rifa = require('../models/Rifa');

module.exports = {
  async listarRifas(req, res) {
    try {
      const rifas = await Rifa.getAll();
      res.json(rifas);
    } catch (err) {
      res.status(500).json({ erro: 'Erro ao buscar rifas' });
    }
  },

  async criarRifa(req, res) {
    try {
      const id = await Rifa.create(req.body);
      res.status(201).json({ id });
    } catch (err) {
      res.status(500).json({ erro: 'Erro ao criar rifa' });
    }
  },

  async rifaPorId(req, res) {
    try {
      const rifa = await Rifa.getById(req.params.id);
      if (!rifa) return res.status(404).json({ erro: 'Rifa não encontrada' });
      res.json(rifa);
    } catch (err) {
      res.status(500).json({ erro: 'Erro ao buscar rifa' });
    }
  },
};

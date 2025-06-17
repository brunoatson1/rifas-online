const Bilhete = require('../models/Bilhete');
const sortear = require('../utils/sorteio');

module.exports = {
  async sortearGanhador(req, res) {
    const { rifaId } = req.params;
    const bilhetes = await Bilhete.getByRifaId(rifaId);
    const ganhador = sortear(bilhetes);
    if (ganhador) {
      res.json({ ganhador });
    } else {
      res.status(404).json({ erro: 'Nenhum bilhete para sortear' });
    }
  }
};

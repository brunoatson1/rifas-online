const jwt = require('jsonwebtoken');
const SECRET = 'chave_secreta_super_segura';

module.exports = {
  login(req, res) {
    const { email, senha } = req.body;

    if (email === 'admin@admin.com' && senha === '123456') {
      const token = jwt.sign({ email }, SECRET, { expiresIn: '2h' });
      res.json({ token });
    } else {
      res.status(401).json({ erro: 'Credenciais inválidas' });
    }
  }
};

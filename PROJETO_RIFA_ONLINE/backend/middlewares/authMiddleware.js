const jwt = require('jsonwebtoken');
const SECRET = 'chave_secreta_super_segura';

function verificarToken(req, res, next) {
  const token = req.headers.authorization?.split(' ')[1];
  if (!token) return res.status(401).json({ erro: 'Token ausente' });

  try {
    const decoded = jwt.verify(token, SECRET);
    req.user = decoded;
    next();
  } catch {
    res.status(403).json({ erro: 'Token inválido' });
  }
}

module.exports = verificarToken;

router.post('/pagamento', bilheteController.gerarPagamento);
const express = require('express');
const router = express.Router();
const bilheteController = require('../controllers/bilheteController');

router.get('/:rifaId', bilheteController.listarPorRifa);
router.post('/', bilheteController.criarBilhete);

module.exports = router;

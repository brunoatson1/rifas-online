const express = require('express');
const router = express.Router();
const rifaController = require('../controllers/rifaController');

router.get('/', rifaController.listarRifas);
router.post('/', rifaController.criarRifa);
router.get('/:id', rifaController.rifaPorId);

module.exports = router;

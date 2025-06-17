const express = require('express');
const router = express.Router();
const mpController = require('../controllers/mpWebhookController');

router.post('/webhook', mpController.receberWebhook);

module.exports = router;
const mercadopago = require('mercadopago');

mercadopago.configure({
  access_token: 'SEU_ACCESS_TOKEN_DO_MERCADO_PAGO'
});

module.exports = mercadopago;

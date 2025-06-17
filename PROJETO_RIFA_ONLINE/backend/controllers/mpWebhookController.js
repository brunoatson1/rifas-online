module.exports = {
  async receberWebhook(req, res) {
    try {
      const evento = req.body;
      console.log('Webhook recebido:', evento);

      // Aqui você pode consultar a API do MP se quiser confirmar o pagamento
      // E atualizar o status do bilhete no banco

      res.status(200).send('OK');
    } catch (err) {
      console.error('Erro no webhook:', err);
      res.status(500).send('Erro interno');
    }
  }
};

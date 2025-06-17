const mongoose = require('mongoose');

const raffleSchema = new mongoose.Schema({
  title: {
    type: String,
    required: [true, 'O título é obrigatório'],
    trim: true,
    maxlength: [100, 'O título não pode ter mais que 100 caracteres'],
  },
  description: {
    type: String,
    required: [true, 'A descrição é obrigatória'],
  },
  price: {
    type: Number,
    required: [true, 'O preço é obrigatório'],
    min: [1, 'O preço mínimo é R$1,00'],
  },
  totalTickets: {
    type: Number,
    required: [true, 'O número total de bilhetes é obrigatório'],
    min: [1, 'Deve haver pelo menos 1 bilhete'],
  },
  soldTickets: {
    type: Number,
    default: 0,
  },
  winner: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
  },
  createdAt: {
    type: Date,
    default: Date.now,
  },
});

module.exports = mongoose.model('Raffle', raffleSchema);

module.exports = Rifa;

require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const raffleRoutes = require('./routes/raffleRoutes');
const connectDB = require('./config/db');

const app = express();
const PORT = process.env.PORT || 3001;

// Middlewares
app.use(cors());
app.use(express.json());

// Conexão com o banco de dados
connectDB();

// Rotas
app.use('/api/raffles', raffleRoutes);

// Error handling
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Erro interno do servidor' });
});

app.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});

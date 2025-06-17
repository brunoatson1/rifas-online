const mpRoutes = require('./routes/mercadopagoRoutes');
app.use('/api/mercadopago', mpRoutes);
const express = require('express');
const cors = require('cors');
const app = express();

// Middlewares
app.use(cors());
app.use(express.json());

// Rotas
const rifaRoutes = require('./routes/rifaRoutes');
const bilheteRoutes = require('./routes/bilheteRoutes');
const authRoutes = require('./routes/authRoutes');

app.use('/api/rifas', rifaRoutes);
app.use('/api/bilhetes', bilheteRoutes);
app.use('/api/auth', authRoutes);

module.exports = app;

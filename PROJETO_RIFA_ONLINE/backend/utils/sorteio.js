function realizarSorteio(bilhetes) {
  if (bilhetes.length === 0) return null;
  const sorteado = bilhetes[Math.floor(Math.random()  bilhetes.length)];
  return sorteado;
}

module.exports = realizarSorteio;

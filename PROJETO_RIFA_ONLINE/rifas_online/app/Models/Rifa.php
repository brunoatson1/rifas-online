<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'preco_bilhete',
        'quantidade_bilhetes',
        'bilhetes_disponiveis',
        'data_sorteio',
        'status',
        'imagem_premio',
    ];

    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }
}
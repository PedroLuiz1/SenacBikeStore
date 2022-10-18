<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    //campos publicaveis
    protected $fillable = ['nomedoproduto', 'anodomodelo', 'precodelista'];

    //nome da chave primária
    protected $primaryKey = 'pkproduto';

    //nome da tabela
    protected $table = 'produtos';

    //informe que esta trabalhando com increment
    public $incrementing = true;

    //nao utiliza timestamps nos controles (created & updated)
    public $timestamps = false;

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'fkcategoria', 'pkcategoria');
    }
}

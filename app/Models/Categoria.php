<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //campos publicaveis
    protected $fillable = ['nomedacategoria'];

    //nome da chave primária
    protected $primaryKey = 'pkcategoria';

    //nome da tabela
    protected $table = 'categorias';

    //informe que esta trabalhando com increment
    public $incrementing = true;

    //nao utiliza timestamps nos controles (created & updated)
    public $timestamps = false;
}

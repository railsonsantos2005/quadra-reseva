<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Quadra extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'disponivel',
        'descricao',
    ];

    protected $casts = [
        'disponivel' => 'boolean',
    ];

    public static function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'disponivel' => 'required|boolean',
            'descricao' => 'nullable|string',
        ];
    }

    public function validate(array $data)
    {
        return Validator::make($data, self::rules())->validate();
    }
}

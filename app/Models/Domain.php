<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function rules()
    {
        return [
            'name' => 'required|unique:domains,name,' .$this->id. '|min:3'
        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.unique' => 'O nome de domínio já existe',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres'
        ];
    }
    public function blocks()
    {
        return $this->hasMany('\App\Models\Block');
    }
}

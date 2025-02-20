<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'domain_id'];

    public function rules()
    {
        return [
            'domain_id' => 'exists:domains,id',
            'name' => 'required|string|min:3'
        ];
    }
    public function domain()
    {
        return $this->hasOne('\App\Models\Domain');
    }


}

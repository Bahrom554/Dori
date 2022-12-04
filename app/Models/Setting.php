<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name',  'file_id', 'type','link'];


    public function file()
    {
        return $this->belongsTo(Files::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'admin_id'];

    public function is_approved()
    {
        return $this->status != 0;
    }
}

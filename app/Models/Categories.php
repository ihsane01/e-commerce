<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom'];
 public function user(){
      return $this->belongsTo(User::class);
        }
 public function product(){
      return $this->hasMany(Products::class);
        }
}

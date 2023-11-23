<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public $table = "estudiantes";
    protected $fillable = array("*"); //all the fields in the table

    //method that returns the list of courses that a student has
    public function estudiantes(){
        return $this->belongsToMany(Curso::class,"curso_estudiante");
    }
}
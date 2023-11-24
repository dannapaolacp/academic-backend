<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $table = "cursos";
    protected $fillable = array("*"); //all the fields in the table

    //method that returns the list of students that a course has
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, "curso_estudiante");
    }
}
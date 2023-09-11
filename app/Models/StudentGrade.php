<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;


    protected $table = 'student_grades';
    protected $primaryKey = 'student_grade_id';


    protected $fillable = [
        'student_list_id',
        'academic_year_id',
        'faculty_id',
        'student_id', 
        'schedule_id',
        'grade'
    ];


    public function academicYear(){
        return $this->hasOne(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function schedule(){
        return $this->hasOne(Schedule::class, 'schedule_id', 'schedule_id');
    }

    public function faculty(){
        return $this->hasOne(User::class, 'user_id', 'faculty_id');
    }

    public function student(){
        return $this->hasOne(User::class, 'user_id', 'student_id');
    }
}

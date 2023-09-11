<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    use HasFactory;


    protected $table = 'student_lists';
    protected $primaryKey = 'student_list_id';


    protected $fillable = ['academic_year_id',
        'schedule_id',
        'faculty_id',
        'student_id', 
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

    public function grade(){
        return $this->hasOne(StudentGrade::class, 'student_list_id', 'student_list_id');
    }

}

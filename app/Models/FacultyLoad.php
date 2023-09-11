<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyLoad extends Model
{
    use HasFactory;

    protected $table = 'faculty_loads';
    protected $primaryKey = 'faculty_load_id';

    protected $fillable = ['user_id', 'academic_year_id', 'schedule_id'];

    

    public function academic_year(){
        return $this->hasOne(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }
    
    public function course(){
        return $this->hasOne(Course::class, 'course_id', 'course_id');
    }

    public function room(){
        return $this->hasOne(Room::class, 'room_id', 'room_id');
    }

    public function schedule(){
        return $this->hasOne(Schedule::class, 'schedule_id', 'schedule_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');

    }


}

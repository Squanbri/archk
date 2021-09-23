<?php namespace Squanbri\Authentication\Models;

use Model;
use Redirect;

/**
 * Model
 */
class Courses extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'squanbri_authentication_courses';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function getCourse($id) {
        $course = Courses::find($id);

        if ($course){
            if ($course->attributes['skills'] !== '') {
                $course->attributes['skills'] = explode(',', $course->attributes['skills']);
            }
        }

        return $course;
    }

    public function getAllCourses() {
        $courses = Courses::all();

        foreach($courses as $course)  
        {
            if ($course->attributes['skills'] !== '') {
                $course->attributes['skills'] = explode(',', $course->attributes['skills']);
            }
        }

        return $courses;
    }
}

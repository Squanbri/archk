<?php namespace Squanbri\Authentication\Models;

use Model;
use Input;
use Validator;
use ValidationException;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Models\Users as UsersModal;

/**
 * Model
 */
class Summaries extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'squanbri_authentication_summaries';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => [\Squanbri\Authentication\Models\Users::class, 'key' => 'id']
    ];

    public function getResume($id) {
        $resume = Summaries::find($id);

        if ($resume){
            if ($resume->attributes['skills'] !== '') {
                $resume->attributes['skills'] = explode(',', $resume->attributes['skills']);
            }
        }
        
        return $resume;
    }

    public function getAllResume() {
        $summaries = Summaries::where('is_hidden', false)->get();
        foreach($summaries as $summary) 
        {
            $user = (new UsersModal)->getUser($summary->id);
            $summary['city'] = $user['city'];
            $summary['sex'] = $user['sex'];
        }

        if ((new Session)->checkType() === 'user') {
            $id = (new Session)->checkAunticate()['id'];
            foreach($summaries as $key => $summary) 
            {
                if ($summary->id === $id) {
                    unset($summaries[$key]);
                }
            }
        }

        return $summaries;
    }
    
    public function getPageResume($page, $offset) {
        return Summaries::skip(($page-1)*$offset)->take($offset)->get();
    }
    
    public function getPagination($offset) {
        return Summaries::paginate($offset);
    }

    public function getCountResume() {
        return Summaries::all()->count();
    }

    public function editResume($id) {
        $data = [
            'profession' => Input::get('profession'), 
            'industry' => Input::get('industry'), 
            'salary' => Input::get('salary'), 
            'schedule' => Input::get('schedule'), 
            'skills' => Input::get('skills'), 
            'experience' => Input::get('experience'), 
            'experience_places' => Input::get('experience_places'), 
            'education' => Input::get('education'), 
            'education_places' => Input::get('education_places'), 
            'about' => Input::get('about'), 
          ];
      
          $attribute = [
              'profession' => 'профессия', 
              'industry' => 'направление', 
              'salary' => 'зарплата', 
              'schedule' => 'график работы', 
              'skills' => 'навыки', 
              'experience' => 'Опыт работы', 
              'experience_places' => 'Предыдущие места работы, должности, функции', 
              'education' => 'образование', 
              'education_places' => 'Учебные заведения, год окончания, специальность', 
              'about' => 'Обо мне', 
          ];
      
          $messages = [
              'required' => 'Поле :attribute обязательно для заполнения.',
          ];
      
          $rules = [            
              'profession' => 'required|between:5,255',
              'industry' => 'required|between:5,255',
              'salary' => 'required|between:5,255',
              'schedule' => 'required|between:5,255',
              'experience' => 'required|between:5,255',
              'education' => 'required|between:5,255',
          ];
      
          $validator = Validator::make($data, $rules, $messages, $attribute);
      
          if($validator->fails()) {
              throw new ValidationException($validator);
          } else {
              $resume = Summaries::find($id) ?? new Summaries();
              $resume->id = $id;
              $resume->profession = $data['profession'];
              $resume->industry = $data['industry'];
              $resume->salary = $data['salary'];
              $resume->schedule = $data['schedule'];
              $resume->skills = $data['skills'];
              $resume->experience = $data['experience'];
              $resume->experience_places = $data['experience_places'];
              $resume->education = $data['education'];
              $resume->education_places = $data['education_places'];
              $resume->about = $data['about'];
              $resume->updated_at = date("d.m.Y");
              if (Summaries::find($id)) 
                $resume->created_at = date("d.m.Y");
              $resume->save();
          }
    }
}

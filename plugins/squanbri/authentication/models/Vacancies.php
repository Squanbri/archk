<?php namespace Squanbri\Authentication\Models;

use Model;
use Crypt;
use Input;
use Redirect;
use Validator;
use ValidationException;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Models\Companies as CompanyModal;

/**
 * Model
 */
class Vacancies extends Model
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
    public $table = 'squanbri_authentication_vacancies';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
        'company' => Companies::class
    ];

    public function getVacancy($id) {
        $vacancy = Vacancies::find($id);
        $vacancy->attributes['company'] = (new CompanyModal)->getCompany($vacancy->companies_id)->name;
        
        if ($vacancy->attributes['skills'] !== '') {
            $vacancy->attributes['skills'] = explode(',', $vacancy->attributes['skills']);
        }

        return $vacancy;
      }

    public function getVacancies($id) {
        $vacancies = Vacancies::where('companies_id', $id)->get();
        return $vacancies;
    }

    public function getAllVacancies() {
        $vacancies = Vacancies::where('is_hidden', false)->get();

        if ((new Session)->checkType() === 'company') {
            $id = (new Session)->checkAunticate()['id'];
            foreach($vacancies as $key => $vacancy) 
            {
                if ($vacancy->companies_id === $id) {
                    unset($vacancies[$key]);
                }
            }
        }

        return $vacancies;
    }

    public function getMostPopularIndustry() 
    {
        $vacancies = $this->getAllVacancies();

        $countIndustry = [];// count industry from all vacancies

        foreach($vacancies as $vacancy) {
            if (isset($countIndustry[$vacancy->industry])) {
                $countIndustry[$vacancy->industry] = $countIndustry[$vacancy->industry] + 1;
            } else {
                $countIndustry[$vacancy->industry] = 1;
            }
        }

        uasort($countIndustry, function($a, $b) { return $a < $b; });

        $mostPopularIndustry = [];
        foreach($countIndustry as $industry => $count) {
            $newArr['industry'] =  $industry;
            $newArr['count'] =  $count;
            array_push($mostPopularIndustry, $newArr);
        }

        return $mostPopularIndustry;
    }

    public function getPageResume($page, $offset) {
        return Vacancies::skip(($page-1)*$offset)->take($offset)->get();
    }
    
    public function getPagination($offset) {
        return Vacancies::paginate($offset);
    }

    public function getCountVacancies() {
        return Vacancies::all()->count();
    }

    public function addVacancy($id) 
    {   
        $data = [
            'profession' => Input::get('profession'), 
            'industry' => Input::get('industry'),
            'city' => Input::get('city'),
            'salary' => Input::get('salary'),
            'schedule' => Input::get('schedule'),
            'experience' => Input::get('experience'),
            'education' => Input::get('education'),
            'skills' => Input::get('skills'),
            'description' => Input::get('description')
        ];

        $attribute = [
            'profession' => 'должность', 
            'industry' => 'направление',
            'city' => 'город',
            'salary' => 'зарплата',
            'schedule' => 'график работы',
            'experience' => 'опыт работы',
            'education' => 'образование',
            'skills' => 'навыки',
            'description' => 'описания'
        ];
    
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    
        $rules = [
            'profession' => 'required|between:3,100',
            'salary' => 'required|min:5',
        ];
    
        $validator = Validator::make($data, $rules, $messages, $attribute);
    
        if($validator->fails()) {
            throw new ValidationException($validator);
        } else {
            $vacancy = new Vacancies;
            $vacancy->profession = $data['profession'];
            $vacancy->industry = $data['industry'];
            $vacancy->city = $data['city'];
            $vacancy->salary = $data['salary'];
            $vacancy->schedule = $data['schedule'];
            $vacancy->experience = $data['experience'];
            $vacancy->education = $data['education'];
            $vacancy->skills = $data['skills'];
            $vacancy->description = $data['description'];
            $vacancy->companies_id = $id;
            $vacancy->created_at = date("d.m.Y");
            $vacancy->updated_at = date("d.m.Y");
            $vacancy->save();
        }
    }

    public function editVacancy($id) {
        $data = [
            'profession' => Input::get('profession'), 
            'industry' => Input::get('industry'),
            'city' => Input::get('city'),
            'salary' => Input::get('salary'),
            'schedule' => Input::get('schedule'),
            'experience' => Input::get('experience'),
            'education' => Input::get('education'),
            'skills' => Input::get('skills'),
            'description' => Input::get('description')
        ];

        $attribute = [
            'profession' => 'должность', 
            'industry' => 'направление',
            'city' => 'город',
            'salary' => 'зарплата',
            'schedule' => 'график работы',
            'experience' => 'опыт работы',
            'education' => 'образование',
            'skills' => 'навыки',
            'description' => 'описания'
        ];
    
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    
        $rules = [
            'profession' => 'required|between:3,50',
            'salary' => 'required|min:5',
        ];
    
        $validator = Validator::make($data, $rules, $messages, $attribute);
    
        if($validator->fails()) {
            throw new ValidationException($validator);
        } else {
            $vacancy = Vacancies::find($id);
            $vacancy->profession = $data['profession'];
            $vacancy->industry = $data['industry'];
            $vacancy->city = $data['city'];
            $vacancy->salary = $data['salary'];
            $vacancy->schedule = $data['schedule'];
            $vacancy->experience = $data['experience'];
            $vacancy->education = $data['education'];
            $vacancy->skills = $data['skills'];
            $vacancy->description = $data['description'];
            $vacancy->updated_at = date("d.m.Y");
            $vacancy->save();
        }
    }

    public function deleteVacancy($id) {
        $vacancy = Vacancies::find($id);
        $vacancy->delete();
    }
}

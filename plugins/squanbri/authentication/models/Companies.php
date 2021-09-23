<?php namespace Squanbri\Authentication\Models;

use Model;
use Crypt;
use Input;
use Validator;
use ValidationException;
use System\Models\File;

/**
 * Model
 */
class Companies extends Model
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
    public $table = 'squanbri_authentication_companies';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'vacancies' => Vacancies::class
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public function editCompany($email, $code=false) 
    {
        $data = [
            'image' => Input::file('image'),
            'name' => Input::get('name'), 
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
            'industry' => Input::get('industry'),
            'description' => Input::get('description'),
        ];

        $attribute = [
            'image' => 'Изображение',
            'name' => 'ФИО',
            'address' => 'адресс',
            'phone' => 'телефон',
            'industry' => 'направление',
        ];
    
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    
        $rules = [
            'name' => 'required|between:3,50',
            'address' => 'required|min:4',
            'phone' => 'required|between:11,15',
            'industry' => 'required',
            'description' => 'max:500',
        ];
    
        $validator = Validator::make($data, $rules, $messages, $attribute);
    
        if($validator->fails()) {
            throw new ValidationException($validator);
        } else {
            $id = Companies::where('email', $email)->first()['id'];

            $user = Companies::find($id);

            if ($data['image']) {
                $file = new File;
                $file->data = $data['image'];
                $file->is_public = true;
                $file->save();
                $user->image()->add($file);
            }
            if ($code) {
                $user->activate_hash = $code;
            }

            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->industry = $data['industry'];
            $user->description = $data['description'];
            $user->save();

            return 'save';
        }
    }

    public function getCompany($id) {
        return Companies::find($id);
    }


    public function activateCompany($email) 
    {
        $id = Companies::where('email', $email)->first()['id'];
        $user = Companies::find($id);
        if ($user) {
            $user->activate = true;
            $user->save();
        }
    }
}

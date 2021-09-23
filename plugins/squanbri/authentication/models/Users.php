<?php namespace Squanbri\Authentication\Models;

use Crypt;
use Model;
use Input;
use Validator;
use System\Models\File;
use ValidationException;
use Squanbri\Authentication\Models\Summaries as SummaryModal;

/**
 * Model
 */
class Users extends Model
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
    public $table = 'squanbri_authentication_users';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasOne = [
        'summary' => [\Squanbri\Authentication\Models\Summaries::class, 'key' => 'id']
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public function getUser($id) {
        return Users::find($id);
    }

    public function getSummary() {
        $email = Crypt::decrypt($_COOKIE['key_authenticate']);
        $user = Users::where('email', $email)->first();
        $summary = $user->summary;
        
        return $summary;
    }

    public function editProfile($email, $code=false) 
    {
        $data = [
            'image' => Input::file('image'),
            'name' => Input::get('name'), 
            'sex' => Input::get('sex'), 
            'birth_date' => Input::get('birth_date'), 
            'city' => Input::get('city'), 
            'phone' => Input::get('phone'), 
        ];

        $attribute = [
            'image' => 'изображение',
            'name' => 'ФИО', 
            'sex' => 'пол', 
            'birth_date' => 'день рождения', 
            'city' => 'город', 
            'phone' => 'телефон', 
        ];
    
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    
        $rules = [            
            'name' => 'required|between:5,60',
            'sex' => 'required',
            'birth_date' => 'required|date',
            'city' => 'required',
        ];
    
        $validator = Validator::make($data, $rules, $messages, $attribute);
    
        if($validator->fails()) {
            throw new ValidationException($validator);
        } else {
            $id = Users::where('email', $email)->first()['id'];

            $user = Users::find($id);

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

            $user->id = $id;
            $user->name = $data['name'];
            $user->sex = $data['sex'];
            $user->birth_date = $data['birth_date'];
            $user->city = $data['city'];
            $user->phone = $data['phone'];
            $user->save();
        }
    }

    public function activateProfile($email) 
    {
        $id = Users::where('email', $email)->first()['id'];
        $user = Users::find($id);
        if ($user) {
            $user->activate = true;
            $user->save();
        }
    }
}

<?php namespace Squanbri\Authentication\Components;

use Hash;
use Input;
use Flash;
use Request;
use Redirect;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Squanbri\Authentication\Classes\Mail;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Models\Users as UserModal;
use Squanbri\Authentication\Models\Companies as CompanyModal;
use Squanbri\Authentication\Models\Vacancies as VacancyModal;

class Account extends ComponentBase {
  public $user;
  public $type;
  public $summary;

  public function componentDetails() {
    return [
      'name' => 'Аккаунт',
      'description' => 'Аунтефикая, проверка ауентификации, регистрация'
    ];
  }

  public function onRun() {
    $session = new Session();
    $this->user = $session->checkAunticate();
    $this->type = $session->checkType();
    
    if ($this->type === 'user') {
      $this->summary = (new UserModal)->getSummary();
    }
    
    $page = $this->page->url;
    if ($page === '/registraciya' || $page === '/autentifikaciya') {
      if ($this->user) 
      {
        return Redirect::to('/');
      }
    } else if ($page === '/') { // Активация аккаунта
      $hash = Request::get('activate');
      $email = Request::get('email');
      $type = Request::get('type');

      if ($hash) {
        var_dump($session->findUser('', $email));
        $activate_hash = $session->findUser('', $email)->activate_hash;

        if ($hash === $activate_hash) {
          if ($type === 'user') {
            (new UserModal)->activateProfile($email);
          } else {
            (new CompanyModal)->activateCompany($email);
          }
        }

        return Redirect::to('/');
      }
    }
  }

  public function onRegistration() 
  { 
    $data = post();

    $attribute = [
      'password' => 'пароль',
      'password_confirmation' => 'подтверждение пароля'
    ];

    $messages = [
      'required' => 'Поле :attribute обязательно для заполнения.',
      'email' => 'Поле email должно содержать адрес электронной почты',
      'same' => 'Поле :attribute должно совподать с полем :other',
      'unique' => 'Такой :attribute уже зарегистрирован'
    ];

    $type = Input::get('type_user');
    if ($type === 'user') {
      $rules = [
        'email' => 'required|email|unique:squanbri_authentication_users',
        'password' => 'required|min:5',
        'password_confirmation' => 'required|min:5|same:password',
        'name' => 'required|between:5,60',
        'sex' => 'required',
        'birth_date' => 'required|date',
        'city' => 'required',
      ];
    } else {
      $rules = [
        'email' => 'required|email|unique:squanbri_authentication_users',
        'password' => 'required|min:5',
        'password_confirmation' => 'required|min:5|same:password',
        'name' => 'required|between:3,50',
        'address' => 'required|min:4',
        'phone' => 'required|between:11,15',
        'industry' => 'required',
      ];
    }

    $validator = Validator::make($data, $rules, $messages, $attribute);

    if($validator->fails()) {
      throw new ValidationException($validator);
    } else 
    {
      $vars = [
        'table' => Input::get('type_user') === 'user' ? 
          'squanbri_authentication_users' : 
          'squanbri_authentication_companies', 
        'email' => Input::get('email'), 
        'password' => Input::get('password')
      ];

      $user = new Session();
      $user->register($vars);

      
      $mail = new Mail();
      $email = $data['email'];
      $code = Hash::make($data['email'].time());
      $type = $data['type_user'] === 'user' ? 'user' : 'company';
      $mail->sendToActivateMail($email, $code, $type);

      if ($type === 'user') {
        (new UserModal)->editProfile($email, $code);
      } else {
        (new CompanyModal)->editCompany($email, $code);
      }

      return Redirect::to('/');
    }
  }

  public function onAuthentication()
  {
    $data = post();

    $attribute = [
      'password' => 'пароль',
    ];

    $messages = [
      'required' => 'Поле :attribute обязательно для заполнения.',
      'email' => 'Поле email должно содержать адрес электронной почты',
    ];

    $rules = [
      'email' => 'required|email',
      'password' => 'required',
    ];

    $validator = Validator::make($data, $rules, $messages, $attribute);

    if($validator->fails()) {
      throw new ValidationException($validator);
    } else {
      $vars = ['table' => 'squanbri_authentication_users', 'email' => Input::get('email'), 'password' => Input::get('password')];
      $session = new Session();
      $user = $session->authenticate($vars);
      $vars['table'] = 'squanbri_authentication_companies';
      $company = $session->authenticate($vars);

      if ($user === true || $company === true) {
        return Redirect::to('/');
      } else if ($user === 'not activated' || $company === 'not activated') {
        Flash::error('Ваш аккаунт не подтверждён, проверьте почту.');
      } else {
        Flash::error('Неверный логин или пароль');
      }

      return Redirect::back()->withInput(post());
    }
  }

  public function onLogout() 
  {
    $session = new Session();
    $session->logout();
    return Redirect::to('/');
  }

  public function onEditProfile() 
  {
    $email = (new Session)->checkAunticate()['email'];
    $result = (new UserModal)->editProfile($email);
  }

  public function onEditCompany()
  {
    $email = (new Session)->checkAunticate()['email'];

    $result = (new CompanyModal)->editCompany($email);
  }

  // GETS
  public function getBirthDate() {
    $id = $this->param('id');
    return (new UserModal)->getUser($id)['birth_date'];
  }
}

?>
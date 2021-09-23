<?php namespace Squanbri\Authentication\Classes;

use Request;

class Filters 
{ 
  public $array;

  function __construct($array) {
    $this->array = $array;
  }

  function filter() {
    
    $city = Request::get('city');
    $sex = Request::get('sex');
    $salary = Request::get('salary');
    $min_salary = intval(Request::get('min_salary'));
    $max_salary = intval(Request::get('max_salary'));
    $industry = Request::get('industry');
    $schedules = ['schedule_full', 'schedule_part', 'schedule_watchkeeper'];
    $experiences = ['experience_none', 'experience_without', 'experience_1-3', 'experience_3-6', 'experience_6'];

    foreach ($this->array as $key => $item) {
      if ($item->city !== $city && $city !== 'Все города' && $city !== NULL) // CITY
      { 
        unset($this->array[$key]);
        continue;
      } 

      if ($sex !== 'Не имеет значения' && $sex !== NULL) // SEX
      { 
        if ($item->sex === 'Мужской' && $sex !== 'male'){
          unset($this->array[$key]);
          continue;
        }
        else if ($item->sex === 'Женский' && $sex !== 'female') {
          unset($this->array[$key]);
          continue;
        }
      } 

      if ($salary === 'Свой диапазон') // SALARY
      { 
        if (intval($item->salary) < intval($min_salary) || intval($item->salary) > intval($max_salary)) 
        {
          unset($this->array[$key]);
          continue;
        }
      }

      if ($item->industry !== $industry  && $industry !== NULL && $industry !== 'Все направления') // INDUSTRY
      {
        unset($this->array[$key]);
        continue;
      }

      $checkboxsActive = []; // SCHEDULE
      foreach ($schedules as $schedule) { 
        if (!is_null(Request::get($schedule))) {
          $checkboxsActive[] = Request::get($schedule);
        }
      }
      if(!empty($checkboxsActive)) 
      {
        if (!in_array($item->schedule, $checkboxsActive)) {
          unset($this->array[$key]);
          continue;
        }
      }


      $checkboxsActive = []; // EXPERINCE
      foreach ($experiences as $experience) { 
        if (!is_null(Request::get($experience))) {
          $checkboxsActive[] = Request::get($experience);
        }
      }
      if(!empty($checkboxsActive)) 
      {
        if (!in_array($item->experience, $checkboxsActive)) {
          unset($this->array[$key]);
          continue;
        }
      }
    }
    
    return $this->array;
  }
}

?>
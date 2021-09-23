<?php namespace Squanbri\Authentication\Classes;

use Input;

class Search 
{
  public $array;

  function __construct($array) {
    $this->array = $array;
  }

  public function search() 
  {
    $str = Input::get('search');
    
    $newArr = [];
    
    if ($str) {
      foreach ($this->array as $item) 
      {
        
        if (mb_stripos($item->profession, $str) !== false) 
        {
          $newArr[] = $item;
        }
      }
    }
    else {
      $newArr = $this->array;
    }

    return $newArr;
  }
}
?>
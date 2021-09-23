<?php namespace Squanbri\Authentication\Classes;

use Input;

class Pagination 
{ 
  public $array;
  public $offset;

  function __construct($array) {
    $this->array = $array;
  }

  public function pagination() {
    $page = Input::get('page') - 1 ?? 0;
    if ($page < 0) $page = 0;

    $offset = Input::get('offset') ?? 4;
    $this->offset = $offset;

    $index = 0;
    foreach ($this->array as $key => $item) {
      $array[$index] = $item;
      ++$index;
    }

    for ($i = $page * $offset; $i < $page * $offset + $offset; $i++) 
    { 
      if (isset($array[$i])) {
        $newArr[] = $array[$i];
      }
    }
    
    $array = $newArr ?? [];

    return $array;
  }

  public function getAllPage() {
    if (!is_null($this->array)) {
      return ceil(count($this->array) / $this->offset);
    }
    else {
      return 0;
    }
  }

  public function getCurrentPage() {
    $page = Input::get('page') - 1 ?? 0;
    if ($page < 0) $page = 0;

    return $page;
  }
}

?>
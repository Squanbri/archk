<?php namespace Squanbri\Authentication\Components;

use Input;
use Request;
use Response;
use Redirect;
use Cms\Classes\ComponentBase;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Classes\Filters as FiltersClass;
use Squanbri\Authentication\Models\Vacancies as VacancyModal;
use Squanbri\Authentication\Models\Companies as CompanyModal;
use Squanbri\Authentication\Components\Pagination as PaginationClass;

class Pagination extends ComponentBase {
  
  public $array;
  public $allPage;
  public $currentPage;

  public function componentDetails() 
  {
    return [
      'name' => 'Пагинация',
      'description' => 'Пагинация'
    ];
  }

  public function pagination($array) {
    $this->array = $array;

    $page = Input::get('page') ?? 0;
    $offset = Input::get('offset') ?? 4;

    if (is_array($this->array)) {
      $this->allPage = count($this->array) / $offset;
      $this->currentPage = $page;
      var_dump($this->currentPage);
    }

    for ($i = $page * $offset; $i < $page * $offset + $offset; $i++) 
    { 
      if (isset($this->array[$i])) {
        $newArr[] = $this->array[$i];
      }
    }
    
    $this->array = $newArr ?? [];

    return $this->array;
  }
}
?>
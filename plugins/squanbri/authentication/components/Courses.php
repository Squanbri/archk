<?php namespace Squanbri\Authentication\Components;

use Input;
use Redirect;
use Cms\Classes\ComponentBase;
use Squanbri\Authentication\Classes\Search;
use Squanbri\Authentication\Classes\Filters;
use Squanbri\Authentication\Classes\Pagination;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Models\Courses as CoursesModal;

class Courses extends ComponentBase {

  public $course;

  public $courses;
  public $countCourses;
  public $allPage;
  public $currentPage;
  public $search;

  public function componentDetails() 
  {
    return [
      'name' => 'Курсы',
      'description' => 'Курсы'
    ];
  }

  public function onRun() {
    return $this->route($this->page->url);
  }

  public function coursesPage() {
    $courses = $this->getSearchCourses();

    $courses = $this->getFilterCourses($courses);
    $this->countCourses = count($courses);
    
    $this->getPaginationCourses($courses);
  }

  public function coursePage() {
    $id = $this->param('id');
    $course = (new CoursesModal)->getCourse($id);

    if (isset($course)) {
      $this->course = $course;
    } else {
      return Redirect::to("404");
    }
  }

  public function getSearchCourses() {
    $courses = (new CoursesModal)->getAllCourses();
    $search = new Search($courses);
    
    $this->search = Input::get('search');

    return $search->search();
  }

  public function getFilterCourses($courses) {
    $filters = new Filters($courses);
    return $filters->filter();
  }

  public function getPaginationCourses($courses) {
    $pagination = new Pagination($courses);
    $this->courses = $pagination->pagination();
    $this->allPage = $pagination->getAllPage();
    $this->currentPage = $pagination->getCurrentPage();
  }

  public function route($route) {
    switch ($route) {
      case '/course/:id':
        return $this->coursePage();
        break;
      case '/courses':
        return $this->coursesPage();
        break;
    }
  }
}

?>
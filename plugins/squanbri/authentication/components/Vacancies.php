<?php namespace Squanbri\Authentication\Components;

use Input;
use Request;
use Response;
use Redirect;
use Cms\Classes\ComponentBase;
use Squanbri\Authentication\Classes\Search;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Classes\Pagination;
use Squanbri\Authentication\Classes\Filters as FiltersClass;
use Squanbri\Authentication\Models\Users as UsersModal;
use Squanbri\Authentication\Models\Vacancies as VacancyModal;
use Squanbri\Authentication\Models\Companies as CompanyModal;

class Vacancies extends ComponentBase {

  public $vacancy;
  public $vacancies;
  public $company_id;
  public $pagination;
  public $countVacancies;
  
  public $allPage;
  public $currentPage;
  
  public $search;

  public $industries;

  public function componentDetails() 
  {
    return [
      'name' => 'Вакансии',
      'description' => 'Вакансии, похожие вакансии'
    ];
  }

  public function onRun() {
    $page = $this->page->url;
    $id = $this->param('id');
    $vacancies = new VacancyModal();    

    if ($page === '/kompaniya/:id') {
      $this->vacancies = $vacancies->getVacancies($id);
    } else if ($page === '/vakansiya/:id') {
      $this->vacancy = $vacancies->getVacancy($id);
    } else if ($page === '/redaktirovanie-vakansii/:id') {
      if (isset((new Session)->checkAunticate()['id'])) {
        $this->company_id = (new Session)->checkAunticate()['id'];
      }
      $this->getAccess();
      $this->vacancy = $vacancies->getVacancy($id);
    } else if ($page === '/vakansii') {
      $this->vacancies = $this->getSearchVacancies();

      $filters = new FiltersClass($this->vacancies);
      $this->vacancies = $filters->filter();

      $this->countVacancies = count($this->vacancies);
      
      $pagination = new Pagination($this->vacancies);
      $this->vacancies = $pagination->pagination();
      $this->allPage = $pagination->getAllPage();
      $this->currentPage = $pagination->getCurrentPage();
    } else if ($page === '/') {
      $this->vacancies = $vacancies->getAllVacancies();
      $this->industries = $this->getMostPopularIndustry();
    } else if ($page === '/api/vacancies') {
      $filter = new FiltersClass($this->getSearchVacancies());
      $this->vacansiesToJson($filter->filter());
    }
  }

  public function getAccess() {
    $vacancy_id = $this->param('id');
    $vacancy_company_id = VacancyModal::find($vacancy_id)->companies_id;
    $user = (new Session)->checkAunticate();
    
    if ($user !== false && $vacancy_company_id === $user['id'])
    {
      return 123;
    }
    else {
      return $this->controller->run('404');
    }
  }

  public function getMostPopularIndustry() 
  {
    return (new VacancyModal)->getMostPopularIndustry();
  }

  public function onAddVacancy() {
    $id = (new Session)->checkAunticate()['id'];
    (new VacancyModal)->addVacancy($id);
  }

  public function onEditVacancy() {
    $vacancy_id = $this->param('id');
    (new VacancyModal)->editVacancy($vacancy_id);
  }

  public function onDeleteVacancy() {
    $vacancy_id = $this->param('id');
    (new VacancyModal)->deleteVacancy($vacancy_id);
  }

  public function onSearch() {    
    $query = Request::all();
    $url = http_build_query($query);
    return Redirect::to("vakansii?$url");
  }

  public function setUrl($page) {
    $query_string = $_SERVER['QUERY_STRING'];

    $query_params = explode('&', $query_string);

    foreach($query_params as $param) 
    {
      $params[explode('=', $param)[0]] = explode('=', $param)[1] ?? 0;
    }

    if (isset($params['page'])) {
      $newUrl = $_SERVER['REDIRECT_URL']."?".str_replace("page=$params[page]", "page=$page", $_SERVER['QUERY_STRING']);
    }
    else {
      $newUrl = $_SERVER['REDIRECT_URL']."?".$_SERVER['QUERY_STRING']."&page=$page";
    }
    return $newUrl;
  }

  public function getSearchVacancies() {
    $vacancies = (new VacancyModal)->getAllVacancies();
    $search = new Search($vacancies);
    
    $this->search = Input::get('search');

    return $search->search();
  }

  public function vacansiesToJson($vacancies) {
    $key = Request::get('key');

    if (!$key || $key !== '0000') {
      return false;
    }


    $vacanciesJson = array();

    foreach($vacancies as $vacancy) {
      $company = (new CompanyModal)->getCompany($vacancy->companies_id);
      $company = json_decode(json_encode($company));
      
      if (isset($company)) 
      {
        $item = array(
          'proffesion' => $vacancy->profession,
          'industry' => $vacancy->industry,
          'salary' => intval($vacancy->salary),
          'city' => $vacancy->city,
          'schedule' => $vacancy->schedule,
          'education' => $vacancy->education,
          'experience' => $vacancy->experience,
          'skills' => explode(',', $vacancy->skills),
          'phone' => $company->phone,
          'email' => $company->email,
          'company' => $company->name,
          'url' => "https://www.rab.archksakhalin.ru/vakansiya/$vacancy->id",
        );
  
        array_push($vacanciesJson, $item);
      }
    }

    echo json_encode($vacanciesJson);
  }
}
?>
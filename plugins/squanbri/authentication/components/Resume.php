<?php namespace Squanbri\Authentication\Components;

use Input;
use Request;
use Response;
use Redirect;
use Cms\Classes\ComponentBase;
use Squanbri\Authentication\Classes\Search;
use Squanbri\Authentication\Classes\Session;
use Squanbri\Authentication\Classes\Telegram;
use Squanbri\Authentication\Classes\Pagination;
use Squanbri\Authentication\Classes\Filters as FiltersClass;
use Squanbri\Authentication\Models\Users as UsersModal;
use Squanbri\Authentication\Models\Summaries as SummariesModal;
use Squanbri\Authentication\Models\Vacancies as VacancyModal;
use Squanbri\Authentication\Models\Companies as CompanyModal;

class Resume extends ComponentBase {

  public $resume;
  public $pagination;
  public $countResume;

  public $allPage;
  public $currentPage;

  public $search;

  public function componentDetails() 
  {
    return [
      'name' => 'Резюме',
      'description' => 'Резюме, похожие резюме'
    ];
  }

  public function onRun() {
    $page = $this->page->url;
    $id = $this->param('id');
    $resume = new SummariesModal();

    if ($page === '/polzovatel/:id') {
      $this->resume = $resume->getResume($id);
    } else if ($page === '/redaktirovanie-resume') {
      $id = (new Session)->checkAunticate()['id'];
      $this->resume = $resume->getResume($id);
    } else if ($page === '/rezyume') {
      $this->resume = $this->getSearchResume();

      $filters = new FiltersClass($this->resume);
      $this->resume = $filters->filter();
      $this->countResume = count($this->resume);
      
      $pagination = new Pagination($this->resume);
      $this->resume = $pagination->pagination();
      $this->allPage = $pagination->getAllPage();
      $this->currentPage = $pagination->getCurrentPage();

    } else if ($page === '/api/resume') {
      $filter = new FiltersClass($this->getSearchResume());
      $this->resumeToJson($filter->filter());
    }
  }

  public function onEditResume() {
    $id = (new Session)->checkAunticate()['id'];
    $resume = new SummariesModal;
    $resume->editResume($id);

    $telegram = new Telegram;
    $user = new UsersModal;
    $resume = $resume->getResume($id);
    $user = $user->getUser($id);
    $telegram->sendResume($resume, $user);
    return false;
  }

  public function onSearch() {    
    $query = Request::all();
    $url = http_build_query($query);
    return Redirect::to("rezyume?$url");
  }

  public function getSearchResume() {
    $resume = (new SummariesModal)->getAllResume();
    $search = new Search($resume);
    
    $this->search = Input::get('search');

    return $search->search();
  }

  public function resumeToJson($resumes) {
    $key = Request::get('key');

    if (!$key || $key !== '0000') {
      return false;
    }


    $resumeJson = array();

    foreach($resumes as $resume) {
      $user = (new UsersModal)->getUser($resume->id);
      $user = json_decode(json_encode($user));
      
      if (isset($user)) 
      {
        $item = array(
          'proffesion' => $resume->profession,
          'industry' => $resume->industry,
          'salary' => intval($resume->salary),
          'city' => $user->city,
          'schedule' => $resume->schedule,
          'education' => $resume->education,
          'experience' => $resume->experience,
          'skills' => explode(',', $resume->skills),
          'phone' => $resume->phone,
          'email' => $resume->email,
          'name' => $resume->name,
          'url' => "https://www.rab.archksakhalin.ru/polzovatel/$resume->id",
        );
  
        array_push($resumeJson, $item);
      }
    }

    echo json_encode($resumeJson);
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
}
?>
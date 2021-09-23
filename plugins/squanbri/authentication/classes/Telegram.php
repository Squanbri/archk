<?php namespace Squanbri\Authentication\Classes;

class Telegram {
  public function sendResume($resume, $user) {

    var_dump($resume, $user);

    $url = 'url/from/Roma.rails';

    $data = array(
      'proffesion' => $resume->profession,
      'sphere_profession' => $resume->industry,
      'salary' => $resume->salary,
      'city' => $user->city,
      'schedule' => $resume->schedule,
      'education' => $resume->education,
      'expirence' => $resume->expirence,
      'skills' => $resume->skills,
      'phone' => $user->phone,
      'email' => $user->email,
      'name' => $user->name,
      'url' => "https://www.rab.archksakhalin.ru/polzovatel/$resume->id",
      'message' => ''
    );

    $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);





    // // use key 'http' even if you send the request to https://...
    // $context  = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // if ($result === FALSE) { /* Handle error */ }

    // var_dump($result);
  }
}
?>
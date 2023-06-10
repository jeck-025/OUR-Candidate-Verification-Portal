 <?php
date_default_timezone_set('Asia/Manila');
session_start();
$GLOBALS['config'] = array(
    'mysql'=>array(
        //local connection
        'host' => '127.0.0.1:3306',
        'username' =>'root',
        'password' =>'',
        // 'db'=>'cave'

        // hostinger connection
        // 'host' => '109.106.251.63',
        // 'username' =>'port7396_cave',
        // 'password' =>'p@ssw0rdBSIT4A',
        // 'db'=>'port7396_caveportal'

        //   'host' => '109.106.254.187',
        //   'username' =>'ceumnlre_root',
        //   'password' =>'Eg5c272klko5',
         'db'=>'ceumnlre_cave'
    ),

    'remember'=>array(
        'cookie_name' => 'hash',
        'cookie_expiry' =>604800
    ),
    'session'=>array(
        'session_name' =>'user',
        'token_name' =>'token'
    )
);
$GLOBALS['config2'] = array(
    'mysql'=>array(
        //local connection
        //'host' => '127.0.0.1:3306',
        //'username' =>'root',
        //'password' =>'',
        //'db'=>'mapdb'

        // hostinger connection
        // 'host' => '109.106.251.63',
        // 'username' =>'port7396_cave_daap',
        // 'password' =>'p@ssw0rdBSIT4A',
        // 'db'=>'port7396_mapdb'

         'host' => '109.106.254.187',
         'username' =>'ceumnlre_root',
         'password' =>'Eg5c272klko5',
         'db'=>'ceumnlre_map'
    ),

    'remember'=>array(
        'cookie_name' => 'hash',
        'cookie_expiry' =>604800
    ),
    'session'=>array(
        'session_name' =>'user',
        'token_name' =>'token'
    )
);

spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/'.$class.'.php';

});
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/functions/sanitize.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/functions/funct.php';
if(Cookie::exists(Conf::get('remember/cookie_name')) && !Session::exists(Conf::get('session/session_name'))){
    $hash = Cookie::get(Conf::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('user_session', array('hash','=',$hash));

    if($hashCheck->count()){
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
 ?>

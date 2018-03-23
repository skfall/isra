<?php
namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

require_once "HelpComponent.php";

class ModelComponent extends HelpComponent
{
	// The other component your component uses
    // public $components = ['Help'];
	
	public function goToHome(){
		$this->r2(RS);
	}
	
    public function getHomeData(){
		$q = "
            SELECT M.*
            FROM `osc_menu` AS M
            WHERE M.block = 0 
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
    public function getHomeBanner(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.".LANG_PREFIX."caption as caption, M.filename
            FROM `osc_home_banner` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
    public function getHomeSteps(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, 
			M.".LANG_PREFIX."caption1 as caption1, M.".LANG_PREFIX."details1 as details1, M.filename1, 
			M.".LANG_PREFIX."caption2 as caption2, M.".LANG_PREFIX."details2 as details2, M.filename2, 
			M.".LANG_PREFIX."caption3 as caption3, M.".LANG_PREFIX."details3 as details3, M.filename3
            FROM `osc_home_steps` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
    public function getHomePrices(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, 
			M.".LANG_PREFIX."caption1 as caption1, M.".LANG_PREFIX."details1 as details1, M.".LANG_PREFIX."text1 as text1, M.filename1, 
			M.".LANG_PREFIX."caption2 as caption2, M.".LANG_PREFIX."details2 as details2, M.".LANG_PREFIX."text2 as text2, M.filename2
            FROM `osc_home_prices` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
		
    public function getHomeStock(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.filename
            FROM `osc_home_stock` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	
		
    public function getHomeStockItems(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.".LANG_PREFIX."caption as caption, M.image
            FROM `osc_home_stock_items` AS M
            WHERE M.block = 0 
            ORDER BY M.order_id
           	LIMIT 1000
        ";
        return $this->q($q);
    }
		
    public function getHomeInfo(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.filename
            FROM `osc_home_info` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
		
    public function getHomeInfoItems(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.".LANG_PREFIX."caption as caption, M.image
            FROM `osc_home_info_items` AS M
            WHERE M.block = 0 
            ORDER BY M.order_id
           	LIMIT 1000
        ";
        return $this->q($q);
    }	
		
    public function getHomeWhyus(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.filename
            FROM `osc_home_why_us` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
		
    public function getHomeWhyusItems(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.".LANG_PREFIX."caption as caption, M.image
            FROM `osc_home_why_us_items` AS M
            WHERE M.block = 0 
            ORDER BY M.order_id
           	LIMIT 1000
        ";
        return $this->q($q);
    }	
		
    public function getHomeReviews(){
		$q = "
            SELECT M.".LANG_PREFIX."title as title, M.".LANG_PREFIX."caption as caption, M.filename
            FROM `osc_home_reviews` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
		
    public function getHomeReviewsItems(){
		$q = "
            SELECT M.".LANG_PREFIX."comment as comment, M.".LANG_PREFIX."author as author, M.".LANG_PREFIX."signature as signature
            FROM `osc_home_reviews_items` AS M
            WHERE M.block = 0 
            ORDER BY M.order_id
           	LIMIT 1000
        ";
        return $this->q($q);
    }
	
	public function getHomeContacts(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."title as title,
			M.".LANG_PREFIX."form_name as form_name,
			M.".LANG_PREFIX."form_email as form_email,
			M.".LANG_PREFIX."form_phone as form_phone,
			M.".LANG_PREFIX."form_message as form_message,
			M.".LANG_PREFIX."details as details
            FROM `osc_home_contacts` AS M
            WHERE 1
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	
	public function getHomeGallery(){
		$q = "
            SELECT M.*
            FROM `osc_files_ref` AS M
            WHERE M.ref_table = 'galleries' AND
			M.ref_id = 1
			ORDER BY M.order_pos
            LIMIT 100
        ";
        return $this->q($q);
    }
	
	public function getAboutData(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0 AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	public function getContactsData(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0  AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	public function getNewsData(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0  AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	public function getNewsItemData(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0  AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	public function getErr404Data(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0  AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }
	
	public function getSitemapData(){
		$q = "
            SELECT M.*, M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0  AND M.alias = '".LA."'
            ORDER BY M.order_id
            LIMIT 1
        ";
        return $this->q($q, 1);
    }

    public function getPageContent($alias,$id=0){
        $q = "
            SELECT M.* 
            FROM `osc_menu` AS M
            WHERE M.block = 0 AND (M.alias='$alias' OR M.id='$id')
            LIMIT 1
        ";
        return $this->q($q,1);
    }

    public function getGlobalConfig(){
        $q = "
            SELECT 
                M.*, 
                M.".LANG_PREFIX."meta_title as meta_title,
                M.".LANG_PREFIX."meta_desc as meta_desc,
                M.".LANG_PREFIX."meta_keys as meta_keys,
                M.".LANG_PREFIX."copyright as copyright
            FROM `osc_total_config` AS M
            LIMIT 1
        ";
        return $this->q($q,1);
    }
	
	public function changeLang(){
		if($this->_post('lang')){
				$_SESSION['lang'] = $this->_post('lang');
				$response['status']='success';
				$response['message']='Language has been changed successfully!';
			}
	}
	
	public function getLanguages(){
        $q = "
			SELECT LCASE(C.alias) as alias, C.name, C.id 
            FROM `osc_site_languages` AS M
            LEFT JOIN `osc_languages` AS C ON C.id = M.lang_id
            WHERE M.block = 0
            ORDER BY M.id
            LIMIT 1000
        ";
        return $this->q($q);
    }
	
	
	public function getTopMenu(){
        $q = "
			SELECT M.*, 
            M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0 AND
			M.is_top = 1
            ORDER BY M.order_id
            LIMIT 30
        ";
        return $this->q($q);
    }
	
	
	public function getFootMenu(){
        $q = "
			SELECT M.*, 
            M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0 AND
			M.is_bottom = 1
            ORDER BY M.order_id
            LIMIT 30
        ";
        return $this->q($q);
    }
	
	protected $st;
	
	public function getStaticTranslations($page=''){
		$q = "
			SELECT ".LANG_PREFIX."text as text, id 
			FROM `osc_static_translations`
			WHERE `page`='$page' OR `page`='all'
			ORDER BY id
			LIMIT 1000
		";
		$st = $this->q($q);
		
		$st_tmp = array();
		foreach($st as $item){
			$st_tmp[$item['id']] = $item['text'];
		}
		$this->st = $st_tmp;
		return $st_tmp;
	}
   
	public function contactForm(){
        $data = array('status' => 'failed', 'message' => '', 'reason' => 'default');

        $name = $this->_post('name');
        $email = $this->_post('email');
        $phone = $this->_post('phone');
        $message = $this->_post('message');
        $ip = $_SERVER['REMOTE_ADDR'];
        $date_created = $this->now();

        if (mb_strlen($name) >= 2) {
            if (mb_strlen($phone) > 10 && $this->check_phone($phone)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (mb_strlen($message) >= 10) {                        
                        $q = "
                            INSERT INTO `osc_contact_form`
                                (`name`, `email`, `phone`, `message`, `ip`, `dateCreate`)
                            VALUES
                                ('$name', '$email', '$phone', '$message', '$ip', '$date_created')
                        ";
                        $success = $this->q($q, 2);
                        if ($success) {
                            $data['status'] = 'success';
                            $data['message'] = 'Ваше сообщение было успешно отправлено.';
							
							$from = "noreply@kam-studio.com.ua";
							$fromName = "KAM STUDIO";
							$to = $email;
							$subject = "New Message";
							$html = "<h1>NEW MESSAGE!</h1><p>$message</p>";
							
							// $this->send_mail($from,$fromName,$to,$subject,$html);
                        }
                    }else{
                        $data['reason'] = 'message';
                        $data['message'] = 'Минимальная длинна комментария - 10 символов.';
                    }
                }else{
                    $data['reason'] = 'email';
                    $data['message'] = 'Укажите корректный email.';
                }
            }else{
                $data['reason'] = 'phone';
                $data['message'] = 'Укажите корректный телефон.';
            }
        }else{
            $data['reason'] = 'name';
            $data['message'] = $this->st[4]; // Enter correct name
        }
        return $data;
    }
	
	public function registerForm(){
        $data = array(
            'status' => 'failed',
            'message' => '',
            'reason' => 'default'
        );

        $name = $this->_post('name');
        $email = $this->_post('email');
        $phone = $this->_post('phone');
        $password = $this->_post('password');
        $pass_confirm = $this->_post('pass_confirm');
        $valid_mark = false;
        $now = $this->now();
        $ip = $_SERVER['REMOTE_ADDR'];

        if (mb_strlen($name) >= 2) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (!$this->check_user($email)) {
                    if ($this->check_phone($phone)) {
                        if (mb_strlen($password) >= 6) {
                            if ($password == $pass_confirm) {
                                $valid_mark = true;
                            }else{
                                $data['message'] = "Пароли не совпадают";
                                $data['reason'] = "pass_confirm";
                            }
                        }else{
                            $data['message'] = "Минимальная длинна пароля - 6 символов";
                            $data['reason'] = "password";
                        }
                    }else{
                        $data['message'] = "Укажите корректный телефон";
                        $data['reason'] = "phone";
                    }
                }else{
                    $data['message'] = "Пользователь с таким email уже существует";
                    $data['reason'] = "email";
                }
            }else{
                $data['message'] = "Укажите корректный email";
                $data['reason'] = "email";
            }
        }else{
            $data['message'] = "Укажите корректное имя";
            $data['reason'] = "name";
        }

        if ($valid_mark === true) {
            $md5_password = md5($password);

            $q = "
                INSERT INTO `osc_users`
                (`name`, `type`, `login`, `pass`, `phone`, `reg_ip`,`last_visit`,`dateCreate`,`dateModify`)
                VALUES 
                ('$name', 9, '$email', '$md5_password', '$phone', '$ip', '$now', '$now', '$now')
            ";

            $insert = $this->q($q, 2);

            if ($insert) {
                $data['status'] = "success";
                $data['message'] = "Успешная регистрация";
                $data['reason'] = "";

                $user_id = $insert->lastInsertId();

                $login_array = array(
                    'uid' => $user_id
                );
                $_SESSION['login'] = $login_array;
				
				$from = "noreply@kam-studio.com.ua";
				$fromName = "KAM STUDIO";
				$to = $email;
				$subject = "SUCCESS REGISTRATION";
				$html = "<h1>SUCCESS REGISTRATION!</h1><p>Welcome.</p>";
				
				// $this->send_mail($from,$fromName,$to,$subject,$html);
            }
        }
        return $data;
    }

    public function loginForm(){
        $data = array(
            'status' => 'failed',
            'message' => '',
            'reason' => 'default'
        );

        $email = $this->_post('email');
        $password = $this->_post('password');
        $valid_mark = false;
        $now = $this->now();
        $ip = $_SERVER['REMOTE_ADDR'];

        $q = "SELECT M.* FROM `osc_users` AS M WHERE M.login = '$email' AND M.block = 0 LIMIT 1";
        $user = $this->q($q, 1);

        if (mb_strlen($email) > 0) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($user) {
                    if (mb_strlen($password) > 0) {
                        if ($user['pass'] == md5($password)) {
                            $uid = $user['id'];
                            $data['status'] = "success";
                            $data['message'] = "Успешная авторизация";
                            $data['reason'] = "";
                            $login_array = array(
                                'uid' => $uid
                            );
                            $_SESSION['login'] = $login_array;

                            $q = "
                                UPDATE `osc_users` SET `last_visit` = '$now', `last_login_ip` = '$ip' WHERE `id` = '$uid' LIMIT 1
                            ";
                            $this->q($q, 2);
                        }else{
                            $data['message'] = "Неверный пароль";
                            $data['reason'] = "password";
                        }
                    }else{
                        $data['message'] = "Введите пароль";
                        $data['reason'] = "password";
                    }
                }else{
                    $data['message'] = "Пользователя с таким email не существует";
                    $data['reason'] = "email";
                }
            }else{
                $data['message'] = "Укажите корректный email";
                $data['reason'] = "email";
            }
        }else{
            $data['message'] = "Введите email";
            $data['reason'] = "email";
        }

        return $data;
    }



}


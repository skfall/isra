<?php
namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

require_once "HelpComponent.php";

class SrgComponent extends HelpComponent {

    public function check_block($alias){
        $q = "SELECT M.id FROM `osc_menu` AS M WHERE M.alias = '$alias' AND M.block = 0 LIMIT 1";
        return $this->q($q, 1);
    }

    public function getMenuItem($alias){
        $q = "
            SELECT 
                M.*,
                M.".LANG_PREFIX."name as name
            FROM `osc_menu` AS M
            WHERE M.block = 0 AND M.alias = '$alias' 
            LIMIT 1
        ";
        return $this->q($q, 1);
    }

    public function getAboutPage(){
        $q = "
            SELECT 
                M.".LANG_PREFIX."caption as caption,
                M.".LANG_PREFIX."details as details,
                M.filename,
                M.b_image_1, 
                M.b_image_2, 
                M.b_image_3,
                M.".LANG_PREFIX."b_title_1 as b_title_1,
                M.".LANG_PREFIX."b_title_2 as b_title_2,
                M.".LANG_PREFIX."b_title_1 as b_title_1,
                M.".LANG_PREFIX."b_title_3 as b_title_3,
                M.".LANG_PREFIX."b_caption_1 as b_caption_1,
                M.".LANG_PREFIX."b_caption_2 as b_caption_2,
                M.".LANG_PREFIX."b_caption_3 as b_caption_3,
                M.".LANG_PREFIX."meta_title as meta_title,
                M.".LANG_PREFIX."meta_keys as meta_keys,
                M.".LANG_PREFIX."meta_desc as meta_desc,
                M.is_index
            FROM `osc_page_about` AS M
            WHERE 
                M.id = 1
            LIMIT 1
        ";
        $about_page = $this->q($q, 1);
        $about_items = array();
        $q = "
            SELECT 
                M.image,
                M.image2,
                M.".LANG_PREFIX."title as title,
                M.".LANG_PREFIX."title2 as title2,
                M.".LANG_PREFIX."caption2 as caption2,
                M.".LANG_PREFIX."caption as caption 
            FROM `osc_page_about_items` AS M 
            WHERE M.block = 0
            ORDER BY M.order_id
            LIMIT 50
        ";
        $about_items = $this->q($q);
        $about_page['items'] = $about_items;
        return $about_page;
    }

    public function getHIWPage(){
        $q = "
            SELECT 
                M.".LANG_PREFIX."caption as caption,
                M.".LANG_PREFIX."caption2 as caption2,
                M.".LANG_PREFIX."details as details,
                M.".LANG_PREFIX."details2 as details2,
                M.".LANG_PREFIX."bottom_desc as bottom_desc,
                M.filename,
                M.filename2,
                M.".LANG_PREFIX."meta_title as meta_title,
                M.".LANG_PREFIX."meta_keys as meta_keys,
                M.".LANG_PREFIX."meta_desc as meta_desc,
                M.is_index
            FROM `osc_page_how_it_works` AS M
            WHERE 
                M.id = 1
            LIMIT 1
        ";
        $HIW_page = $this->q($q, 1);
        $HIW_items = array();
        $q = "
            SELECT 
                M.filename,
                M.".LANG_PREFIX."title as title,
                M.".LANG_PREFIX."details as details
            FROM `osc_page_how_it_works_items` AS M 
            WHERE M.block = 0
            ORDER BY M.order_id
            LIMIT 50
        ";
        $HIW_items = $this->q($q);
        $HIW_page['items'] = $HIW_items;
        return $HIW_page;
    }

    public function getPricesPage(){
        $q = "
            SELECT 
                M.".LANG_PREFIX."caption as caption,
                M.".LANG_PREFIX."details as details,
                M.filename,
                M.".LANG_PREFIX."meta_title as meta_title,
                M.".LANG_PREFIX."meta_keys as meta_keys,
                M.".LANG_PREFIX."meta_desc as meta_desc,
                M.is_index
            FROM `osc_page_prices` AS M
            WHERE 
                M.id = 1
            LIMIT 1
        ";
        $prices_page = $this->q($q, 1);
        $prices_items = array();
        $q = "
            SELECT 
                M.".LANG_PREFIX."title as title,
                M.".LANG_PREFIX."details as details
            FROM `osc_page_prices_items` AS M 
            WHERE M.block = 0
            LIMIT 50
        ";
        $prices_items = $this->q($q);
        $prices_page['items'] = $prices_items;

        $prices_val = array();
        $q = "
            SELECT 
                M.".LANG_PREFIX."title as title,
                M.".LANG_PREFIX."caption1 as caption1,
                M.".LANG_PREFIX."details1 as details1,
                M.".LANG_PREFIX."text1 as text1,
                M.filename1,
                M.".LANG_PREFIX."caption2 as caption2,
                M.".LANG_PREFIX."details2 as details2,
                M.".LANG_PREFIX."text2 as text2,
                M.filename2
            FROM `osc_home_prices` AS M
            WHERE M.id = 1
            LIMIT 1
        ";
        $prices_val = $this->q($q, 1);
        $prices_page['val'] = $prices_val;

        return $prices_page;
    }

    public function modalForm(){
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
                            INSERT INTO `osc_income_questions`
                                (`name`, `email`, `phone`, `message`, `dateCreate`)
                            VALUES
                                ('$name', '$email', '$phone', '$message', '$date_created')
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
}


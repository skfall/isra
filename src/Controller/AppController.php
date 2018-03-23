<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

require_once(ROOT .DS. "config" . DS  . "CP.php");

class AppController extends Controller
{
	public $cp;
	
	public function initialize()
    {
        parent::initialize();
		
		// Custom settings ini
		$this->cp = new \CP();
		
		// Обращение к привычному массиву $ri
		// debug($this->cp->ri); 
		
		$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		
		$this->viewBuilder()->layout('Project');
        date_default_timezone_set('Europe/Kiev');
		
		// GET COMPONENTS
        $this->loadComponent('Help');
		$this->loadComponent('Model');
		$this->loadComponent('Srg');
		
		$this->cp->check_true_url( 
			$this->Help->check_language(FA),
			$this->Help->check_language(LANG) 
		);
		
		if(!$this->Help->check_language(LANG)){
			$_SESSION['lang'] = DEF_LANG;
			$this->Help->r2(RS);
		}
		
				
		// GET TOTAL CONFIG
        $site_config = $this->Model->getGlobalConfig();
        
		// Default META TAGS
		$meta_title = (isset($site_config['meta_title']) ? $site_config['meta_title'] : "");
        $meta_desc = (isset($site_config['meta_desc']) ? $site_config['meta_desc'] : "");
        $meta_keys = (isset($site_config['meta_keys']) ? $site_config['meta_keys'] : "");
		
		// CHECK LOGIN
		if (isset($_SESSION['login'])) {
            $user = $this->Help->check_user($_SESSION['login']['uid'], 'id');
            if ($user) {
                define('ONLINE', true);
                define('UID', $_SESSION['login']['uid']);
            }else{
				$_SESSION['login']=NULL;
				unset($_SESSION['login']);
                $this->Help->r2(RS);
            }
        }else{
            define('ONLINE', false);
            define('UID', 0);
        }
		
		$langs = $this->Model->getLanguages();

        // SET GLOBAL DATA
        $this->set([
            'site_config' => $site_config,
			'langs'	=>	$langs,
            'meta_title' => $meta_title,
            'meta_desc' => $meta_desc,
            'meta_keys' => $meta_keys,
			'user' => (ONLINE ? $user : array())
        ]);
		
		$topMenu = $this->Model->getTopMenu();
		$this->set('topMenu', $topMenu);
		
		$footMenu = $this->Model->getFootMenu();
		$this->set('footMenu', $footMenu);
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}

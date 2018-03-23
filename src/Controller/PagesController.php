<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
	public function home()
    {
		if(LANG!=DEF_LANG && LANG!=FA)
		{
			if(FA==DEF_LANG){
				$_SESSION['lang'] = DEF_LANG;
				$this->Help->r2(RS);
			}else{
				$this->Help->r2(RS.LANG.'/');
			}
		}
		if(LANG==DEF_LANG && FA!='home') $this->Help->r2(RS);
		
		$st = $this->Model->getStaticTranslations('home');
		$data = $this->Model->getHomeData();
		
		$this->set([
			"st"	=> $st,
			"data" 	=> $data
			]);		
		
		$homeBanner = $this->Model->getHomeBanner();
		$this->set("homeBanner", $homeBanner);
		
		$homeSteps = $this->Model->getHomeSteps();
		$this->set("homeSteps", $homeSteps);
		
		$homePrices = $this->Model->getHomePrices();
		$this->set("homePrices", $homePrices);
		
		$homeStock = $this->Model->getHomeStock();
		$this->set("homeStock", $homeStock);
		
		$homeStockItems = $this->Model->getHomeStockItems();
		$this->set("homeStockItems", $homeStockItems);
		
		$homeInfo = $this->Model->getHomeInfo();
		$this->set("homeInfo", $homeInfo);
		
		$homeInfoItems = $this->Model->getHomeInfoItems();
		$this->set("homeInfoItems", $homeInfoItems);		
		
		$homeWhyus = $this->Model->getHomeWhyus();
		$this->set("homeWhyus", $homeWhyus);
		
		$homeWhyusItems = $this->Model->getHomeWhyusItems();
		$this->set("homeWhyusItems", $homeWhyusItems);		
		
		$homeReviews = $this->Model->getHomeReviews();
		$this->set("homeReviews", $homeReviews);
		
		$homeReviewsItems = $this->Model->getHomeReviewsItems();
		$this->set("homeReviewsItems", $homeReviewsItems);		
		
		$homeContacts = $this->Model->getHomeContacts();
		$this->set("homeContacts", $homeContacts);	
		
		
		$homeGallery = $this->Model->getHomeGallery();
		$this->set("homeGallery", $homeGallery);
		
	}
	
	public function about(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }
		$st = $this->Model->getStaticTranslations('about');
		$menu_item = $this->Srg->getMenuItem('about');
		if ($menu_item) {
			$about = $this->Srg->getAboutPage();
		}else{
			$this->Help->r2(RS.'404/');
		}
		$this->set([
			"st"	=> $st,
			"about" 	=> $about,
			"menu_item" => $menu_item
		]);
	}
	
	public function contacts(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }
		
		$st = $this->Model->getStaticTranslations('contacts');
		$data = $this->Model->getContactsData();
		
		$this->set([
			"st"	=> $st,
			"data" 	=> $data
			]);		
		
		$homeContacts = $this->Model->getHomeContacts();
		$this->set("homeContacts", $homeContacts);
	}

	public function terms(){

	}

	public function privacy(){
		
	}

	public function returnPolicy(){
		
	}

	public function hworks(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }
		$st = $this->Model->getStaticTranslations('how-it-works');
		$menu_item = $this->Srg->getMenuItem('how-it-works');
		if ($menu_item) {
			$HIW = $this->Srg->getHIWPage();
		}else{
			$this->Help->r2(RS.'404/');
		}
		$this->set([
			"st"	=> $st,
			"hiw" 	=> $HIW,
			"menu_item" => $menu_item
		]);
	}

	public function prices(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }
		$st = $this->Model->getStaticTranslations('prices');
		$menu_item = $this->Srg->getMenuItem('prices');
		if ($menu_item) {
			$prices = $this->Srg->getPricesPage();
		}else{
			$this->Help->r2(RS.'404/');
		}
		$this->set([
			"st"	=> $st,
			"prices" 	=> $prices,
			"menu_item" => $menu_item
		]);
	}

	public function storage(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }

		$st = $this->Model->getStaticTranslations('prices');
		$menu_item = $this->Srg->getMenuItem('prices');
		if ($menu_item) {
			$prices = $this->Srg->getPricesPage();
		}else{
			$this->Help->r2(RS.'404/');
		}
		$this->set([
			"st"	=> $st,
			"prices" 	=> $prices,
			"menu_item" => $menu_item
		]);
	}

	public function services(){
		if(LANG!=FA){ $_SESSION['lang'] = FA; }

		$st = $this->Model->getStaticTranslations('prices');
		$menu_item = $this->Srg->getMenuItem('prices');
		if ($menu_item) {
			$prices = $this->Srg->getPricesPage();
		}else{
			$this->Help->r2(RS.'404/');
		}
		$this->set([
			"st"	=> $st,
			"prices" 	=> $prices,
			"menu_item" => $menu_item
		]);
	}
}

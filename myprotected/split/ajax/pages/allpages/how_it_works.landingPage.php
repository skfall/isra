<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>1, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getLandingHeader($headParams);
	
	// Set lultilanguage FIELDS (Israel - empty, ru, en, fr)
	
	$lang_fields = array(
		'caption',
		'details',
		'meta_title',
		'meta_keys',
		'meta_desc'
	);
	
	$sqlLog = "";
	
	ob_start();
		
		// GET PAGE DATA
		$cardData = $zh->getPageItem($pageTable, $lpx, $lang_fields);
	
	$sqlLog = ob_get_contents();
	ob_get_clean();
	
	$langs = $zh->getAvailableLangs();
	$lpx_name = strtoupper($lpx ? $lpx : DEF_LANG);
	
	$cardItem = $cardData['cardItem'];
	$menuInfo = $cardData['menuInfo'];
	
	// Get page items
	
	$itemsList = $zh->getPageHowItWorksItems($params);

	$totalItems = $zh->getPageHowItWorksItems($params,true);
	
	// Pagination operations
	
	$on_page = (isset($_COOKIE['global_on_page']) ? $_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
	
	$pages = ceil($totalItems/$on_page);
	
	$start_page = (isset($params['start']) ? $params['start'] : 1);
	
	$frst_page = 1;
	$prev_page = 1;
	$next_page = $pages;
	$last_page = $pages;
				
	if($start_page < $pages) $next_page = $start_page+1;
	if($start_page > 1) $prev_page = $start_page-1;
	
	// Filter JS open
	
	if(isset($_COOKIE['filter-1']) && $_COOKIE['filter-1']) $data['filter']['f1'] = 1;
	if(isset($_COOKIE['filter-2']) && $_COOKIE['filter-2']) $data['filter']['f2'] = 1;
	if(isset($_COOKIE['filter-3']) && $_COOKIE['filter-3']) $data['filter']['f3'] = 1;
	
	// Filter arrays

	$filter1_options = array( 'By ID'=>'M.id', 'By Name'=>'M.name' );
	
	$filter2_options = array( 
							'Публикация'	=> array( 'fieldName'=>'M.block', 'params' => array('Yes'=>'0', 'No'=>'1') )
							);
							
	$filter3_options = array( 
							'sort' => array( 'ID'=>'id', 'Порядковому номеру'=>'order_id' ),
							'order' => array( 'По возрастанию'=>'', 'По убыванию'=>' DESC' ) 
							);
	// Start data content
	
	$filterFormParams = array(	'params'=>$params, 
								'headParams'=>$headParams, 
								'filter1_options'=>$filter1_options, 
								'filter2_options'=>$filter2_options, 
								'filter3_options'=>$filter3_options, 
								'on_page'=>$on_page 
							  );
	
	$filterFormStr = $zh->getLandingFilterForm($filterFormParams);
	
	// Table structure
	
	$tableColumns = array(
						  'Checkbox'			=>	array('type'=>'checkbox',	'field'=>''),
						  'Title'				=>	array('type'=>'text',		'field'=>'title'),
						  'Icon'				=>	array('type'=>'text',		'field'=>'filename'),
						  'Публикация'			=>	array('type'=>'block',		'field'=>'block'),
						  '№'					=>	array('type'=>'text',		'field'=>'order_id'),
						  'Просмотр'			=>	array('type'=>'cardView',	'field'=>'Смотреть'),
						  'Редактирование'		=>	array('type'=>'cardEdit',	'field'=>'Редактировать'),
						  'ID'					=>	array('type'=>'text',		'field'=>'id')
						  );
	
	$tableParams = array( 'itemsList'=>$itemsList, 'tableColumns'=>$tableColumns, 'headParams'=>$headParams );
	
	$tableStr = $zh->getItemsTable($tableParams);
	
	// START PAGINATION
	
	$pagiParams = array( 'headParams'=>$headParams, 'start_page'=>$start_page, 'pages'=>$pages, 'on_page'=>$on_page );
	
	$pagiStr = $zh->getLandingPagination($pagiParams);
	
	// Join Content
	
	$data['bodyContent'] = ""; // $filterFormStr;
	
	// new block
	
	$data['bodyContent'] .= "
		<div id='landCluster' class='animatedX'>
			<h3 class='new-line'>Редактирование страницы <b>".$menuInfo['name']."</b></h3>
	";
	
		$rootPath = ROOT_PATH;
		
		$cardTmp = array(
			 
			 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field
			 
			 // 'Основная информация'	=>	array( 'type'=>'header' ),
			 
			 'Caption '.$lpx_name	=>	array( 'type'=>'input', 	'field'=>'caption', 	'params'=>array( 'size'=>100, 'hold'=>'Page caption' ) ),
			 
			 'Clear-1'			=>	array( 'type'=>'clear' ),
			 
			 
			 'Details '.$lpx_name	=>	array( 'type'=>'redactor', 	'field'=>'details', 	'params'=>array( 'hold'=>'Page details' ) ),
			 
			 'Clear-2'			=>	array( 'type'=>'clear' ),
					 
			 'Banner Title '.$lpx_name		=>	array( 'type'=>'input', 	'field'=>'b_title', 		'params'=>array( 'size'=>100, 'hold'=>'Ban Title' ) ),
			 
			 'clear-21'				=>	array( 'type'=>'clear' ),
			 
			 'Индексация'		=>	array( 'type'=>'block', 	'field'=>'is_index', 'params'=>array( 'reverse'=>false ) ),
			 
			 
			 'META INFO'		=>	array( 'type'=>'header'),
			 
			 'Meta Title '.$lpx_name		=>	array( 'type'=>'input', 	'field'=>'meta_title', 'params'=>array( 'size'=>100, 'hold'=>'Meta title' ) ),
			 
			 'Clear-3'			=>	array( 'type'=>'clear' ),
			 
			 'Meta Keys '.$lpx_name			=>	array( 'type'=>'input', 	'field'=>'meta_keys', 'params'=>array( 'size'=>100, 'hold'=>'Meta Keywords' ) ),
			 
			 'Clear-4'			=>	array( 'type'=>'clear' ),
			 
			 'Meta Description '.$lpx_name	=>	array( 'type'=>'area', 		'field'=>'meta_desc', 'params'=>array( 'size'=>100, 'hold'=>'Meta Description' ) ),
			 
			 
			 
			 'Файлы'			=>	array( 'type'=>'header'),

			 'Изображение'		=>	array( 'type'=>'image_mono', 'field'=>'filename', 		'params'=>array( 'path'=>RSF."/split/files/content/", 'appTable'=>$pageTable, 'id'=>1 ) ),
			 
			 'Имя изображения'	=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"filename" ) )
																										 
			 );
	
		$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editPageHowItWorks", 'ajaxFolder'=>'edit', 'appTable'=>$pageTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs, 'clickUpdate'=>'landingPage' );
		
		$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams, true);
		
		$data['bodyContent'] .= $cardEditFormStr;
		
		ob_start();
		
		if($sqlLog) echo "<pre>"; print_r($sqlLog); echo "</pre>";
		
		$data['bodyContent'] .= ob_get_contents();
		ob_get_clean();
	
	$data['bodyContent'] .= "</div><!-- landCluster --><div class='divider'></div>";
	
	// end new block
	
	$data['bodyContent'] .= "<h2 class='tableCaption'>Дополнительные услуги:</h2>";
	
	$data['bodyContent'] .= $tableStr;
	
	$data['bodyContent'] .= $pagiStr;
	

?>
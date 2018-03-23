<?php 	// Start header content	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>1, 'appTable'=>$appTable );		$data['headContent'] = $zh->getLandingHeader($headParams);		$lang_fields = array(		'title'	);		$sqlLog = "";		ob_start();				// GET PAGE DATA		$cardData = $zh->getHomeSectionItem($pageTable, $lpx, $lang_fields);		$sqlLog = ob_get_contents();	ob_get_clean();		$langs = $zh->getAvailableLangs();	$propositions = $zh->getSimplePropositions();	$lpx_name = strtoupper($lpx ? $lpx : DEF_LANG);		$cardItem = $cardData['cardItem'];	$menuInfo = $cardData['menuInfo'];		// Get page items		$itemsList = $zh->getHomeInfo($params);	$totalItems = $zh->getHomeInfo($params,true);		// Pagination operations		$on_page = (isset($_COOKIE['global_on_page']) ? $_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);		$pages = ceil($totalItems/$on_page);		$start_page = (isset($params['start']) ? $params['start'] : 1);		$frst_page = 1;	$prev_page = 1;	$next_page = $pages;	$last_page = $pages;					if($start_page < $pages) $next_page = $start_page+1;	if($start_page > 1) $prev_page = $start_page-1;		// Filter JS open		if(isset($_COOKIE['filter-1']) && $_COOKIE['filter-1']) $data['filter']['f1'] = 1;	if(isset($_COOKIE['filter-2']) && $_COOKIE['filter-2']) $data['filter']['f2'] = 1;	if(isset($_COOKIE['filter-3']) && $_COOKIE['filter-3']) $data['filter']['f3'] = 1;		// Filter arrays	$filter1_options = array( 'By ID'=>'M.id', 'By Name'=>'M.name' );		$filter2_options = array( 							'Публикация'	=> array( 'fieldName'=>'M.block', 'params' => array('Yes'=>'0', 'No'=>'1') )							);								$filter3_options = array( 							'sort' => array( 'ID'=>'id', 'Порядковому номеру'=>'order_id' ),							'order' => array( 'По возрастанию'=>'', 'По убыванию'=>' DESC' ) 							);	// Start data content		$filterFormParams = array(	'params'=>$params, 								'headParams'=>$headParams, 								'filter1_options'=>$filter1_options, 								'filter2_options'=>$filter2_options, 								'filter3_options'=>$filter3_options, 								'on_page'=>$on_page 							  );		$filterFormStr = $zh->getLandingFilterForm($filterFormParams);		// Table structure		$tableColumns = array(						  'Checkbox'			=>	array('type'=>'checkbox',	'field'=>''),						  'Title'				=>	array('type'=>'text',		'field'=>'title'),						  'Image icon'			=>	array('type'=>'text',		'field'=>'image'),						  'Публикация'			=>	array('type'=>'block',		'field'=>'block'),						  '№'					=>	array('type'=>'text',		'field'=>'order_id'),						  'Просмотр'			=>	array('type'=>'cardView',	'field'=>'Смотреть'),						  'Редактирование'		=>	array('type'=>'cardEdit',	'field'=>'Редактировать'),						  'ID'					=>	array('type'=>'text',		'field'=>'id')						  );		$tableParams = array( 'itemsList'=>$itemsList, 'tableColumns'=>$tableColumns, 'headParams'=>$headParams );		$tableStr = $zh->getItemsTable($tableParams);		// START PAGINATION		$pagiParams = array( 'headParams'=>$headParams, 'start_page'=>$start_page, 'pages'=>$pages, 'on_page'=>$on_page );		$pagiStr = $zh->getLandingPagination($pagiParams);		// Join Content		$data['bodyContent'] = $filterFormStr;		// РАЗРЫВ СТЕРЕОТИПА!		$data['bodyContent'] .= "		<div id='landCluster' class='animatedX'>			<h3 class='new-line'>Редактирование секции <b>".$menuInfo['name']."</b></h3>	";			$rootPath = ROOT_PATH;				$cardTmp = array(			 'LPX'		=>	array( 'type'=>'hidden',	'field'=>'lpx', 'value'=>$lpx ), // multilanguage important field			 			 'Title '.$lpx_name		=>	array( 'type'=>'input', 'field'=>'title', 	'params'=>array( 'size'=>100, 'hold'=>'Title' ) ),			 'clear-0' => array( 'type'=>'clear' ),			 'Спец предложение'		=>	array( 'type'=>'select', 	'field'=>'prop_id',		'params'=>array( 'list'=>$propositions,					 																									 'first'=>array( 'name'=>'Не выбрано', 'id'=>0 ), 					 																									 'fieldValue'=>'id', 																														 'fieldTitle'=>'name',																														 'currValue'=>$cardItem['prop_id'], 																														 'value'=>$cardItem['prop_id']																														 ) )			 );			$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editHomeInfo", 'ajaxFolder'=>'edit', 'appTable'=>$pageTable, 'lpx'=>$lpx, 'headParams'=>$headParams, 'langs'=>$langs, 'clickUpdate'=>'landingPage' );				$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams, true);				$data['bodyContent'] .= $cardEditFormStr;		$data['bodyContent'] .= "</div><!-- landCluster --><div class='divider'></div>";		// ЗАВЕРШЕНИЕ РАЗРЫВА СТЕРЕОТИПА!		$data['bodyContent'] .= "<h2 class='tableCaption'>Items List:</h2>";		$data['bodyContent'] .= $tableStr;		$data['bodyContent'] .= $pagiStr;?>
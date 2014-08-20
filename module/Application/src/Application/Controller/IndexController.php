<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter as PaginatorAdapter;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    
    public function listunitsAction() {
        $sampleData = array(
	       array('1','Peter Parker','2004-12-34'),
           array('2','Peter Pan','2003-12-34'),
           array('3','Uncle Ben','2012-12-34'),
           array('4','Peter Parker','2004-12-34'),
           array('5','Peter Pan','2003-12-34'),
           array('6','Uncle Ben','2012-12-34'),
        );
        

        @$page  = (int)$_REQUEST['page'];
        @$limit = (int)$_REQUEST['limit'];
        if($page == 0) {
        	$page = 1;
        }
        if($limit == 0) {
        	$limit = 3;
        }
        
        // Example for pre-processing of the data...
        $odd = (boolean)$_REQUEST['odd'];
        if($odd) {
        	foreach ($sampleData as $i => $row) {
        	    if($row[0] % 2) {
        	    	unset($sampleData[$i]);
        	    }
        	}
        }
        
    	$adapter = new PaginatorAdapter($sampleData);
    	$paginator = new Paginator($adapter);
    	$paginator->setCurrentPageNumber($page);
    	$paginator->setItemCountPerPage($limit);
    	
    	$viewModel = new ViewModel(array(
    		'paginator' => $paginator,
    	    'page'      => $page,
    	    'limit'     => $limit,
    	    'odd'       => $odd,
    	));
    	
    	$viewModel->setTerminal(true);
    	
    	return $viewModel;
    }
    
    
    public function listworkcodesAction() {
        
    }
}

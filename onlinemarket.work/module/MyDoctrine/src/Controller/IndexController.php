<?php
//*** DOCTRINE LAB: this class is completed already for your reference
namespace MyDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}

<?php
//*** DOCTRINE LAB: see hints below
namespace MyDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController implements RepoAwareInterface
{
    use RepoTrait;

    public function indexAction()
    {
        $eventId = $this->params('event');
        if ($eventId) {
            return $this->listRegistrations($eventId);
        }
        //*** DOCTRINE LAB: use event repo to find all
        $events = ???;
        $viewModel = new ViewModel(array('events' => $events));
        return $viewModel;
    }

    protected function listRegistrations($eventId)
    {
        //*** DOCTRINE LAB: use event repo to find by event ID
        $event = ???;
        $viewModel = new ViewModel(array('event' => $event));
        $viewModel->setTemplate('my-doctrine/admin/list.phtml');
        return $viewModel;
    }
}

<?php
//*** DOCTRINE LAB: see hints below
namespace MyDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter;

//*** implement the RepoAwareInterface
class SignupController extends AbstractActionController implements RepoAwareInterface
{
    //*** use the RepoTrait
    use RepoTrait;
    protected $regDataFilter;
    public function indexAction()
    {
        $eventId = (int) $this->params('event');
        if ($eventId) {
            return $this->eventSignup($eventId);
        }
        //*** DOCTRINE LAB: use event repo to find all
        $events = $this->eventRepo->findAll();
        return new ViewModel(array('events' => $events));
    }

    public function thanksAction()
    {
        return new ViewModel();
    }

    protected function eventSignup($eventId)
    {
        //*** DOCTRINE LAB: use event repo to find by event ID
        $event = $this->eventRepo->findById($eventId);
        if (!$event) {
            return $this->notFoundAction();
        }
        $vm = new ViewModel(array('event' => $event));
        if ($this->request->isPost()) {
            $this->processForm($this->params()->fromPost(), $event);
            $vm->setTemplate('my-doctrine/signup/thanks.phtml');
        } else {
            $vm->setTemplate('my-doctrine/signup/form.phtml');
        }
        return $vm;
    }

    protected function processForm(array $formData, $event)
    {
        $formData = $this->sanitizeData($formData);
        //*** DOCTRINE LAB: use registration repo to save
        $reg = ???;
        //*** DOCTRINE LAB: set the new registration back into the related event + save
        ???
        //*** save all attendees for this registration
        foreach ($formData['ticket'] as $nameOnTicket) {
            //*** DOCTRINE LAB: use attendo repo to save each attendee
            ???
            //*** DOCTRINE LAB: append attendee to current registration
            ???
        }
        return true;
    }

    protected function sanitizeData(array $data)
    {
        $clean  = array();
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                foreach ($item as $subKey => $subItem) {
                    $clean[$key][$subKey] = $this->regDataFilter->filter($subItem);
                }
            } else {
                $clean[$key] = $this->regDataFilter->filter($item);
            }
        }
        return $clean;
    }
    public function setRegDataFilter($filter)
    {
        $this->regDataFilter = $filter;
    }
}

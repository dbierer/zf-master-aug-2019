<?php
namespace Market\Controller;

use Market\Form\UploadTrait;
use Market\Event\LogEvent;
use Market\Listener\CacheAggregate;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
//*** EMAIL LAB: add "use" statement to trigger email notification event
//use Notification\Event\NotificationEvent;

class PostController extends AbstractActionController implements ListingsTableAwareInterface
{

    const ERROR_POST = 'ERROR: unable to validate item information';
    const ERROR_SAVE = 'ERROR: unable to save item to the database';
    const SUCCESS_POST = 'SUCCESS: item posted OK';

    use FlashTrait;
    use PostFormTrait;
    use ListingsTableTrait;
    use CityCodesTableTrait;
    use UploadTrait;

    public function indexAction()
    {

        $data = [];

        if ($this->getRequest()->isPost()) {

            //*** FILE UPLOAD LAB: combine $_POST with $_FILES
            $data = array_merge($this->params()->fromPost(), $this->params()->fromFiles());
            $this->postForm->setData($data);

            if ($this->postForm->isValid()) {

                // retrieve data: due to form binding will get a Model\Entity\Listing instance
                $listing = $this->postForm->getData();

                //*** FILE UPLOAD LAB: move uploaded file from /images folder into /images/<category>
                $tmpFn     = $listing->photo_filename['tmp_name'];
                $tmpDir    = dirname($tmpFn);
                $partialFn = '/' . $listing->category . '/' . basename($tmpFn);
                $finalFn   = str_replace('//', '/', $tmpDir . $partialFn);
                rename($tmpFn, $finalFn);

                //*** FILE UPLOAD LAB: reset $listing->photo_filename'] to final filename /images/<category>/filename
                $listing->photo_filename = $this->uploadConfig['img_url'] . $partialFn;

                // save data and process
                if ($this->listingsTable->save($listing)) {

                    $this->flash->addMessage(self::SUCCESS_POST);
                    //*** EMAIL LAB: trigger an email notification of success; also, use class constant instead of hard-coded event
                    $this->getEventManager()->trigger('notification-event-email-notification', $this, ['message' => 'Successfully posted ' . $listing->title]);
                    //*** EVENTMANAGER LAB: trigger a log event and pass the online market item title as a parameter
                    $em = $this->getEventManager();
                    $em->addIdentifiers([LogEvent::LOG_ID]);
                    $em->trigger(LogEvent::LOG_EVENT, $this, ['title' => $listing->title]);
                    //*** CACHE LAB: trigger event which signals clear cache
                    $cacheKey = 'market_view_category_' . $listing->category;
                    $em->trigger(CacheAggregate::EVENT_CLEAR_CACHE, $this, ['cacheKey' => $cacheKey]);
                    return $this->redirect()->toRoute('market');

                } else {

                    $this->flash->addMessage(self::ERROR_SAVE);

                }

            } else {

                $this->flash->addMessage(self::ERROR_POST);

            }
        }

        $viewModel = new ViewModel(['postForm' => $this->postForm, 'data' => $data, 'flash' => $this->flash]);
        $viewModel->setTemplate('market/post/index');
        return $viewModel;

    }

}

<?php
namespace Admin\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class DeletePageAction implements ServerMiddlewareInterface
{
    private $router;
    private $template;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null)
    {
        $this->router   = $router;
        $this->template = $template;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // grab params
        $params  = $request->getQueryParams();
        $id      = $params['id'] ?? FALSE;
        $delete  = $params['del'] ?? FALSE;
        $confirm = $params['confirm'] ?? FALSE;
        $success = $params['success'] ?? 0;

        // view data
        $data['routerName']   = 'Zend Router';
        $data['templateName'] = 'Twig';
        $data['response']     = $request->getParsedBody();
        $data['id']           = $id;
        $data['success']      = $success;   // 1 == success; -1 == failed; 0 == never happened
        $data['title']        = $params['title'] ?? '';

        if ($delete) {
            if (!$confirm) {
                return new HtmlResponse($this->template->render('admin::delete-page', $data));
            } else {
                return new HtmlResponse($this->template->render('admin::delete-confirm-page', $data));
            }
        }
        return $delegate->process($request);
    }

}

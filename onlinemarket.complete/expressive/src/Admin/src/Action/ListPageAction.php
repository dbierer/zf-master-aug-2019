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

class ListPageAction implements ServerMiddlewareInterface
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
        // this is where it gets different:
        $params  = $request->getQueryParams();
        $id      = $params['id'] ?? FALSE;
        $confirm = $params['confirm'] ?? FALSE;
        $data['routerName']   = 'Zend Router';
        $data['templateName'] = 'Twig';
        $data['response']     = $request->getParsedBody();
        $data['id']           = $id;
        return new HtmlResponse(
                $this->template->render('admin::list-page', $data));
    }

}

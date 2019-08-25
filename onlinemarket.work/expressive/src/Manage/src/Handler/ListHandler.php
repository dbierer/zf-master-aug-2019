<?php
declare(strict_types=1);
namespace Manage\Handler;

use Manage\Domain\ListingsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ListHandler implements RequestHandlerInterface
{
    const LINES_PER_PAGE = 20;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    /**
     * @var ListingsService
     */
    private $service;
    public function __construct(TemplateRendererInterface $renderer, ListingsService $service)
    {
        $this->renderer = $renderer;
        $this->service  = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $message = '';
        $page = $request->getAttributes()['page'] ?? 0;
        $listings = $this->service->fetchAllPaginated(self::LINES_PER_PAGE, $page * self::LINES_PER_PAGE);
        return new HtmlResponse($this->renderer->render('manage::list', ['listings' => $listings, 'message' => $message]));
    }
}

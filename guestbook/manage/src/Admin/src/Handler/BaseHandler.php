<?php
declare(strict_types=1);
namespace Admin\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

abstract class BaseHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    protected $renderer;

    /**
     * @var GuestbookService
     */
    protected $service;

    public function __construct(TemplateRendererInterface $renderer, GuestbookService $service)
    {
        $this->renderer = $renderer;
        $this->service  = $service;
    }

    abstract public function handle(ServerRequestInterface $request) : ResponseInterface;
}

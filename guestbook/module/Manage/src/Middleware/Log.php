<?php
namespace Manage\Middleware;

use Interop\Http\ServerMiddleware\ {MiddlewareInterface,DelegateInterface};
use Psr\Http\Message\ {ServerRequestInterface, ResponseInterface};

class Log implements MiddlewareInterface
{
    use TableTrait;
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data['ip_v4_address'] = $request->getServerParams()['REMOTE_ADDR'];
        $data['uri']           = $request->getUri()->__toString();
        $routeMatch = $request->getAttribute('Zend\Router\RouteMatch');
        $routeMatch->setParam(__CLASS__, $this->table->insert($data));
        return $delegate->process($request, $delegate);
    }
}

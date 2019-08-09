<?php
namespace Admin\Service;

use Zend\Db\TableGateway\TableGateway;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class Listing implements MiddlewareInterface
{
    protected $table;
    public function setTable(TableGateway $table)
    {
        $this->table = $table;
    }
    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data   = $action = [];
        $params = $request->getQueryParams();
        $id      = $params['id'] ?? FALSE;
        $delete  = $params['del'] ?? FALSE;
        $confirm = $params['confirm'] ?? FALSE;

        if ($id) {
            $data = $this->table->select(['listings_id' => (int) $id])->toArray();
            if ($delete && $confirm) {
                $params['title'] = $data['title'];
                if ($this->table->delete(['listings_id' => (int) $id])) {
                    $params['success'] = 1;
                } else {
                    $params['success'] = -1;
                }
            }
        } else {
            $data = $this->table->select()->toArray();
        }
        return $delegate->process($request->withMethod('POST')
                                   ->withParsedBody($data)
                                   ->withQueryParams($params));
    }
}

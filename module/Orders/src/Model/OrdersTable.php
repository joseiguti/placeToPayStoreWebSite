<?php
namespace Orders\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class OrdersTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getOrder($id)
    {
        $id = (int) $id;
        
        $rowset = $this->tableGateway->select(['id' => $id]);
        
        $row = $rowset->current();
        
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveOrder(Orders $order)
    {
        $data = [
            'customer_name' => $order->customer_name,
            'customer_email' => $order->customer_email,
            'customer_mobile' => $order->customer_mobile,
            'status' => 'CREATED',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $id = (int) $order->id;

        if ($id === 0) {
            
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getOrder($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteOrder($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
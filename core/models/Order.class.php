<?php

namespace models;
use library\Db;

class Order
{   
    public $db;
    public $_data;
    public function __construct($id = null)
    {
        $this->_db = Db::getInstance();

        if (!is_null($id)) {
            $this->find($id);
        }
    }

    public function get($where = null)
    {
        if ($where == 'all_orders') {
            $sql = "SELECT orders.id, flowers.title,  flowers.img_name, orders.date_addet, flowers.price, orders.full_name, orders.tel 
                    FROM `orders` 
                    INNER JOIN `flowers` ON flowers.id = orders.product_id 
                    ORDER BY orders.id DESC";
    
            $Orders = $this->_db->query($sql);
        }

        if (!$Orders->count()) {
            return null;
        }else {
            foreach ($Orders->results() as $Orders) {
                
                $data[] = (array) $Orders;    
            }
            return $data;
        }
    }


    public function find($id = null)
    {
        if (!is_null($id)) {
            $data = $this->_db->get('orders', array('id', '=', $id));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    } 

    public function create($fields = array())
    {
        if (!$this->_db->insert('orders', $fields)) {
            throw new \Exception('Возникла проблема при записи!');            
        }
    }

    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('orders', $id, $fields)) {
            throw new Exception("При обновлении возникла проблема");
        }
    }

    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function data()
    {
        return $this->_data;
    }

}
<?php

namespace models;
use library\Db;

class Flowers
{   
    public $db;
    public $_data;
    public function __construct($id = null)
    {
        $this->db = Db::getInstance();

        if (!is_null($id)) {
            $this->find($id);
        }
    }

    public function get($where, $id = null)
    {
        if ($where == 'all_flowers') {
            $sql = "SELECT flowers.id, flowers.title, flowers.text, flowers.img_name, flowers.date, flowers.price, users.login, catalog_flowers.category_name 
                    FROM `flowers` 
                    INNER JOIN `users` ON flowers.author_id = users.id 
                    INNER JOIN `catalog_flowers` ON flowers.category_id = catalog_flowers.id 
                    ORDER BY flowers.id DESC";
    
            $Flowers = $this->db->query($sql);
        }
        
        if ($where == 'all_category') {
            $sql = "SELECT * FROM `catalog_flowers`";
            $Flowers = $this->db->query($sql);
        }

        if ($where == 'categoryName') {
            $Flowers = $this->db->get('catalog_flowers', array('id', '=', $id));
            return $Flowers->first();
        }

        if ($where == 'flowersWithCategory') {
            $sql = "SELECT flowers.id, flowers.title, flowers.text, flowers.date, flowers.price, flowers.img_name FROM `flowers`
                      INNER JOIN `users` ON flowers.author_id = users.id
                      WHERE flowers.category_id = {$id}
                      ORDER BY flowers.id DESC";

            $Flowers = $this->db->query($sql);
        }

        if (!$Flowers->count()) {
            return null;
        }else {
            foreach ($Flowers->results() as $Flowers) {
                
                $data[] = (array) $Flowers;    
            }
            return $data;
        }

    }

    public function find($id = null)
    {
        if (!is_null($id)) {
            $data = $this->db->get('flowers', array('id', '=', $id));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    } 

    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('flowers', $id, $fields)) {
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

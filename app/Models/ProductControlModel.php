<?php namespace App\Models;

use CodeIgniter\Model;

class ProductControlModel extends Model
{
    protected $table = 'products_control';
    protected $primarykey = 'id';
    protected $allowedFields = ['name','count','product_id','type','created_at','updated_at','user_id'];

    protected $useTimestamps = true;
    protected $createdField ='created_at';
    protected $updatedField ='updated_at';

    public function get($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->asArray()
        ->where (['id' => $id])
        ->first();

    }
}
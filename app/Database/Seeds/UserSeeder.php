<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        //CUSTOMER
        for($i=0; $i < 5; $i++){
            $userModel->insert(
                [
                    'username' =>"regular$i",
                    'email' => "regular$i@gmail.com",
                    'password' => '12345',
                    'type' =>'customer'
                ]
                );
        }
        //SALESMAN
        for($i=0; $i < 5; $i++){
            $userModel->insert(
                [
                    'username' =>"salesman$i",
                    'email' => "salesman$i@gmail.com",
                    'password' => '12345',
                    'type' =>'salesman'
                ]
                );
        }
        //PROVIDER
        for ($i = 0; $i < 5; $i++) {
            $userModel->insert(
                [
                    'username' => "provider$i",
                    'email' => "provider$i@gmail.com",
                    'password' => '12345',
                    'type' => 'provider'
                ]
            );
        }

        //ADMIN
        $userModel->insert(
            [
                'username' =>"admin",
                'email' => "admin@gmail.com",
                'password' => '12345',
                'type' =>'admin'
            ]
            );
        
    }
}

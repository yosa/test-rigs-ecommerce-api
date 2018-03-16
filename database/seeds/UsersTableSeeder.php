<?php

use Illuminate\Database\Seeder;
use App\Models\User;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
        $emailUser = env('TEST_USER_EMAIL'); 
        $userFake = factory(User::class)->make([
            'email'=>$emailUser,
        ])->toArray();
        $userFake ['password']= bcrypt(env('TEST_USER_PASSWORD'));
        User::updateOrCreate([
            'email'=>$emailUser
        ], $userFake);
    }
    
}

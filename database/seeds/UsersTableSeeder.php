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
            'isAdmin'=>true
        ])->toArray();
        $userFake ['password']= bcrypt(env('TEST_USER_PASSWORD'));
        User::updateOrCreate([
            'email'=>$emailUser
        ], $userFake);
        User::updateOrCreate([
            'email'=>env('TEST_USER_EMAIL_NO_ADMIN')
        ], [
            'name'=>'Test no admin',
            'password'=>bcrypt(env('TEST_USER_PASSWORD_NO_ADMIN'))
        ]);
    }
    
}

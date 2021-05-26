<?php

use Illuminate\Database\Seeder;
use App\User;
class CompanyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = -1;
        $user->name = "Dr HelpDesk Bot";
        $user->email = 'bot@drhelpdesk.in';
        $user->password = bcrypt('@drhelpdesk.in');
        $user->save();
    }
}

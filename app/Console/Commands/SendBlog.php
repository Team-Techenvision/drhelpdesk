<?php
 
namespace App\Console\Commands;

use App\User;
use App\Blog; 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
 
class SendBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:day';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a latest blog';
     
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
     
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $users = User::all();
    	$blog_data = Blog::orderBy('blogs_id', 'DESC')->first();
    	$data['blogs_id'] = $blog_data->blogs_id;
    	$data['blog_title'] = $blog_data->blog_title;
    	$data['blog_description'] = $blog_data->blog_description;
    	$data['blog_image'] = $blog_data->blog_image;
        foreach ($users as $user) {
            Mail::send('emails.blog', ['user' => $user, 'data'=>$data], function($message) use ($user) {
                $message->to($user->email, $user->name)
                ->subject('Latest Blog');
                $message->from('dhd@lsne.in','Drhelpdesk');
            });
        }
         
    }
}
<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => str_slug($page),
                'image'=>'https://online.hbs.edu/Style%20Library/api/resize.aspx?imgpath=/PublishingImages/overhead-view-of-business-strategy-meeting.jpg&w=1200&h=630',
                'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Debitis id quia minus quae vero perferendis non, 
                 similique ad voluptas officiis praesentium assumenda 
                 ullam ipsum numquam sunt nulla vel ducimus explicabo?',
                'order'=>$count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
























    }
}

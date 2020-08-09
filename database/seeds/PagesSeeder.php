<?php

use Illuminate\Database\Seeder;

use App\Models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array(
                'title'=>'About us',
                'slug'=>'about-us',
                'summary'=>'This is about the page',
                'Description'=>'This is a description'
            ),
            array(
                'title'=>'Privacy policy',
                'slug'=>'privacy-policy',
                'summary'=>'This is about the privacy policy',
                'Description'=>'This is a privacy policy'
            ),
            array(
                'title'=>'Terms and conditions ',
                'slug'=>'terms-and-conditions',
                'summary'=>'This is about the Terms and conditions',
                'Description'=>'This is a Terms and conditions'
            ),
            array(
                'title'=>'Return policy ',
                'slug'=>'return-policy',
                'summary'=>'This is about the return policy',
                'Description'=>'This is a return policy'
            ),
            array(
                'title'=>'Help & FAQs ',
                'slug'=>'Help-FAQs',
                'summary'=>'This is about the    Help & FAQs',
                'Description'=>'This is a Help & FAQs'
            )
        );
        foreach($array as $page_info){
            $page = new Page;
            $page= $page->where('slug' ,$page_info['slug'])->first();
            if(!$page){
                $page = new Page;
                $page->fill($page_info);
                $page->save();

            }
        }
    }
}

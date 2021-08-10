<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        DB::table('locales')->insert([
            ['lang' => 'es', 'text' => 'Spanish'],
            ['lang' => 'en', 'text' => 'English']
        ]);
        DB::table('news_classes')->insert([
            ['name' => 'events', 'lang' => 'en', 'text' => 'Events'],
            ['name' => 'events', 'lang' => 'es', 'text' => 'Eventos'],
            ['name' => 'conferences', 'lang' => 'en', 'text' => 'Conferences'],
            ['name' => 'conferences', 'lang' => 'es', 'text' => 'Conferencias'],
            ['name' => 'intership', 'lang' => 'en', 'text' => 'Intership'],
            ['name' => 'intership', 'lang' => 'es', 'text' => 'Intercambio']
        ]);
        DB::table('project_classes')->insert([
            ['name' => 'current', 'lang' => 'en', 'text' => 'Current Projects'],
            ['name' => 'current', 'lang' => 'es', 'text' => 'Proyectos Actuales'],
            ['name' => 'past', 'lang' => 'en', 'text' => 'Past Projects'],
            ['name' => 'past', 'lang' => 'es', 'text' => 'Proyectos Anteriores']
        ]);
        DB::table('sections')->insert([
            ['url' => 'about'],
            ['url' => 'research'],
            ['url' => 'footer_work'],
            ['url' => 'footer_about'],
        ]);
        DB::table('descriptions')->insert([
            ['section_id'=>1, 'lang'=>'en', 'title'=>'About Us','type'=>'section','text'=>''],
            ['section_id'=>2, 'lang'=>'en', 'title'=>'Reseach','type'=>'section','text'=>''],
            ['section_id'=>3, 'lang'=>'en', 'title'=>'Work With Us','type'=>'section','text'=>''],
            ['section_id'=>4, 'lang'=>'en', 'title'=>'About Us','type'=>'section','text'=>'']
        ]);
        DB::table('configurations')->insert([
            ['name' => 'address', 'type' => 'str', 'value' => 'Departament ..., University ..., Address, City, Country.'],
            ['name' => 'brochure', 'type' => 'file', 'value' => 'brochure.pdf'],
            ['name' => 'copyright', 'type' => 'html', 'value' => 'Research Group...'],
            ['name' => 'email', 'type' => 'str', 'value' => 'info@research.org'],
            ['name' => 'favicon', 'type' => 'file', 'value' => 'favicon.ico'],
            ['name' => 'footer', 'type' => 'html', 'value' => 'Webmaster: <a href="mailto:webmaster@research.org">Name</a>'],
            ['name' => 'institution', 'type' => 'str', 'value' => 'University name'],
            ['name' => 'lang', 'type' => 'str', 'value' => 'en'],
            ['name' => 'latest_news_number', 'type' => 'num', 'value' => '4'],
            ['name' => 'linkedin', 'type' => 'url', 'value' => 'http://www.linkedin.com/company/xxx'],
            ['name' => 'logo-white-large.png', 'type' => 'file', 'value' => 'logo-white-large.png'],
            ['name' => 'logo_color_large', 'type' => 'file', 'value' => 'logo-color-large.png'],
            ['name' => 'logo_color_small', 'type' => 'file', 'value' => 'logo-color-small.png'],
            ['name' => 'logo_white_small', 'type' => 'file', 'value' => 'logo-white-large.png'],
            ['name' => 'map_iframe', 'type' => 'html', 'value' => '<iframe src="https://www.google.com/maps/embed" width="600" height="450" style="border:0;" allowfullscreen=" loading="lazy"></iframe>'],
            ['name' => 'name', 'type' => 'str', 'value' => 'Research Group'],
            ['name' => 'news_number', 'type' => 'num', 'value' => '10'],
            ['name' => 'phone', 'type' => 'str', 'value' => '+99-999-999-9999'],
            ['name' => 'publications_years_number', 'type' => 'num', 'value' => '10'],
            ['name' => 'researchgate', 'type' => 'url', 'value' => 'https://www.researchgate.net/lab/xxxx'],
            ['name' => 'short_name', 'type' => 'str', 'value' => 'RESEARCH'],
            ['name' => 'template', 'type' => 'str', 'value' => 'arsha'],
            ['name' => 'wallpaper', 'type' => 'file', 'value' => 'wallpaper.jpg'],
        ]);

    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Member;
use App\Models\Publication;
use App\Models\Project;
use App\Models\ProjectClass;
use App\Models\Description;
use App\Models\News;
use App\Models\NewsClass;
use App\Models\Configuration;
use App\Models\Section;

class PageController extends Controller{

    public function __construct(){
        $this->middleware(function ($request, $next){
            PageController::init($request->session()->get('locale'));
            return $next($request);
        });
    }

    private function init($lang){
        $this->config = Configuration::get_all();
        $this->config->lang = ($lang) ? $lang : $this->config->lang;
        App::setLocale($this->config->lang);
        $this->params = [
            'config' => $this->config,
            'locales' => Configuration::get_locales(),
            'footer_work' => Section::get_descriptions('footer_work', $this->config->lang)[0],
            'footer_about' => Section::get_descriptions('footer_about', $this->config->lang)[0],
            'latest_news' => News::orderBy('date','desc')->limit($this->config->latest_news_number)->get(),
        ];
    }

    public function page(Request $req, $url){
        return view($this->config->template.".page", array_merge($this->params, [
            'page' => 'section',
            'url' => $url,
            'descriptions' => [$url => Section::get_descriptions($url, $this->config->lang)],
            'parity' => [$url => 'odd'],
            'full_description' => true,
        ]));
    }

    public function index(Request $req){
        return view($this->config->template.".home", array_merge($this->params, [
            'members' => Member::orderBy('order')->get(),
            'descriptions' => [
                'research' => Section::get_descriptions('research', $this->config->lang, 'section'),
                'about' => Section::get_descriptions('about', $this->config->lang, 'section'),
            ],
            'full_description' => false,
        ]));
    }

    public function members(Request $req){
        return view($this->config->template.".page", array_merge($this->params, [
            'page' => 'members',
            'members' => Member::orderBy('order')->get(),
        ]));
    }

    public function member(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'member',
            'member' => Member::where('url','=',$req->segment(2))->firstOrFail(),
        ]));
    }

    public function publications(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'publications',
            'publications' => Publication::orderBy('year','desc')->get(),
            'years_number' => $this->config->publications_years_number,
        ]));
    }

    public function publication(Request $req, $url){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'publication',
            'publication' => Publication::where('url', '=', $url)->firstOrFail(),
        ]));
    }

    public function patents(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'patents',
            'patents' => Publication::where('type','=','patent')->orderBy('year','desc')->get(),
        ]));
    }

    public function projects(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'projects',
            'classes' => ProjectClass::where('lang','=',$this->config->lang)->get(),
            'projects' => Project::where('type','=','project')->orderBy('period','desc')->get(),
        ]));
    }

    public function project(Request $req, $url){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'project',
            'project' => Project::where('url', '=', $url)->firstOrFail(),
        ]));
    }

    public function developments(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'developments',
            'classes' => ProjectClass::where('lang','=',$this->config->lang)->get(),
            'developments' => Project::where('type','=','development')->orderBy('period','desc')->get(),
        ]));
    }

    public function development(Request $req, $url){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'development',
            'development' => Project::where('url', '=', $url)->firstOrFail(),
        ]));
    }

    public function news(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'news',
            'category' => '',
            'classes' => NewsClass::where('lang','=',$this->config->lang)->get(),
            'news' => News::orderBy('date','desc')
                ->simplePaginate($this->config->news_number),
        ]));
    }

    public function news_category(Request $req, $category){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'news',
            'category' => $category,
            'classes' => NewsClass::where('lang','=',$this->config->lang)->get(),
            'news' => News::where('class','like','%'.$category.'%')
                ->orderBy('date','desc')
                ->simplePaginate($this->config->news_number),
        ]));
    }

    public function new(Request $req, $year, $month, $day, $url){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'new',
            'category' => '',
            'classes' => NewsClass::where('lang','=',$this->config->lang)->get(),
            'new' => News::where('url', '=', $url)
                ->firstOrFail(),
        ]));
    }
    
    public function contact(Request $req){
        return view($this->config->template.'.page', array_merge($this->params, [
            'page' => 'contact',
        ]));
    }

    public function locale(Request $request, $locale){
        foreach($this->params['locales'] as $l){
            if ($l->lang == $locale){
                $request->session()->put('locale', $locale);
                break;
            }
        }
        return back();
    }
}

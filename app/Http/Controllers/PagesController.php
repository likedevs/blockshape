<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use App\MPages;
use App\MSubscription;
use App\MSeminars;
use App\MEvents;
use App\MVideoStories;
use App\MPhotoStories;
use App\MVideo;
use App\MProjects;
use View;

class PagesController extends MainController
{
    public function index()
    {
        $data['photos'] = MPhotoStories::where('show_home', 1)->get();
        return view('front.pages.index', $data);
    }

    public function show($page)
    {
        return view('pages.view', [
            'page' => Page::whereSiteId(site_id())
                ->whereSlug($page)
                ->first(),
        ]);
    }

    public function getPages($page)
    {
        $checkPage = MPages::where('slug', $page)
                            ->first();

        if (is_null($checkPage)) {
            dd('404');
        }

        if(method_exists($this, 'get'.ucfirst($checkPage->slug))){
            $page = MPages::where('slug', $checkPage->slug)->first();
            if (!is_null($page)) {
                return $this->{'get'.ucfirst($checkPage->slug)}($checkPage->slug, $page);
            }
        }
        dd("404");
    }

    public function getConditions($slug, $page)
    {
        $data = [];
        return view('front.pages.pages.conditions', $data);
    }

    public function getAbout_author($slug, $page)
    {
        $data['photos'] = MPhotoStories::where('show_home', 1)->get();
        $data['projects'] = MProjects::get();
        $data['page'] = $page;
        return view('front.pages.pages.about-author', $data);
    }

    public function getSubscriptions($slug, $page)
    {
        $data['subscriptions'] = MSubscription::where('type', 'subscription')->get();
        $data['page'] = $page;

        return view('front.pages.pages.subscriptions', $data);
    }

    public function getSeminars($slug, $page)
    {
        $data['seminars'] = MSeminars::where('end', '<=', 'srttotime(date("Y-m-d"))')
                                    ->orderBy('begin', 'desc')
                                    ->get();
        $data['page'] = $page;
        return view('front.pages.pages.seminars', $data);
    }

    public function getEvents($slug, $page)
    {
        $data['events'] = MEvents::where('end', '<=', 'srttotime(date("Y-m-d"))')
                                ->orderBy('begin', 'desc')
                                ->get();
        $data['page'] = $page;
        return view('front.pages.pages.events', $data);
    }

    public function getSuccess_stories($slug, $page)
    {
        $data['photos'] = MPhotoStories::get();
        $data['videos'] = MVideoStories::get();
        $data['page'] = $page;
        return view('front.pages.pages.success_stories', $data);
    }

    public function getVideos($slug, $page)
    {
        $data['video'] = MVideo::first();
        $data['page'] = $page;
        return view('front.pages.pages.videos', $data);
    }

    public function getProjects($slug, $page)
    {
        $data['projects'] = MProjects::get();
        $data['page'] = $page;
        return view('front.pages.pages.projects', $data);
    }

    public function getContacts($slug, $page)
    {
        $data['projects'] = MProjects::get();
        $data['page'] = $page;
        return view('front.pages.pages.contacts', $data);
    }

    public function getFaq($slug, $page)
    {
        $data['projects'] = MProjects::get();
        $data['page'] = $page;
        return view('front.pages.pages.faq', $data);
    }

    public function getConsultation($slug, $page)
    {
        $data['subscriptions'] = MSubscription::where('type', 'consultation')->get();

        $data['page'] = $page;
        return view('front.pages.pages.consultation', $data);
    }

    public function getFreeWeek($slug, $page)
    {
        $data['projects'] = MProjects::get();
        $data['page'] = $page;
        return view('front.pages.pages.free-week', $data);
    }

    public function water()
    {
        $data = [];
        return view('front.pages.pages.water', $data);
    }

    public function getSingleSeminar($seminar)
    {
        $checkSeminar = MSeminars::where('slug', $seminar)->first();

        if (is_null($checkSeminar)) { return dd(404); }

        $data['seminar'] = $checkSeminar;
        return view('front.pages.pages.seminar-single', $data);
    }

    public function getSingleEvent($event)
    {
        $checkEvent = MEvents::where('slug', $event)->first();

        if (is_null($checkEvent)) { return dd(404); }

        $data['event'] = $checkEvent;
        return view('front.pages.pages.event-single', $data);
    }

    public function getSingleProject($project)
    {
        $checkProject = MProjects::where('slug', $project)->first();

        if (is_null($checkProject)) { return dd(404); }

        $data['project'] = $checkProject;
        return view('front.pages.pages.project-single', $data);
    }

    public function freeWeek()
    {
        $data = [];
        return view('front.pages.pages.free-week', $data);
    }

    public function getArchive($year = null)
    {
        if (!is_null($year)) {
            $data['photos'] = MPhotoStories::where('date', 'LIKE', '%'.$year.'%')->get();
        }else{
            $data['photos'] = MPhotoStories::get();
        }
        return view('front.pages.pages.archive', $data);
    }
}

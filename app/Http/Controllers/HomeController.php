<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $currentUserId = \Auth::user()->id;
            $client = new \GuzzleHttp\Client();
            $res = $client->post(
                'http://127.0.0.1:5000/r2s/v1/recommend/itemstouser',
                array(
                    'form_params' => array(
                        'appId' => 1,
                        'userId' => 98,
                        'count' => 10,
                    )
                )
            );
            $key = strval(98);
            $recommendCourseIdList = json_decode($res->getBody()->getContents())->$key;
            $recommmendCourseList = \App\Models\Course::whereIn('id', $recommendCourseIdList)->get();
        } catch (\Exception $e) {
            $recommmendCourseList = [];
        }

        return view('home', compact(
            'recommmendCourseList'
        ));
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        \Session::save();

        return redirect()->back();
    }

//    public function export()
//    {
//        $people = Person::all();
//
//        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
//
//        $csv->insertOne(\Schema::getColumnListing('people'));
//
//        foreach ($people as $person) {
//            $csv->insertOne($person->toArray());
//        }
//
//        $csv->output('people.csv');
//    }
}

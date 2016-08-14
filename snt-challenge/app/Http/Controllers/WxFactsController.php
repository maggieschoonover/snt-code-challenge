<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HomeWxFacts;
use Validator;
use Route;

class WxFactsController extends Controller
{   
     /**
     * The wxFacts model instance.
     */
    protected $wxFacts;
    protected $request;

     /**
     * Create a new controller instance.
     *
     * @param  HomeWxFacts  $wxFacts
     * @return void
     */
    public function __construct(HomeWxFacts $wxFacts)
    {
        $this->wxFacts = $wxFacts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->wxFacts->all()->toJson();
        // return $data;
        return view('wxFacts.index', ['wxFacts' => $data]);
    }

    /**
     * Return All wx data as JSON.
     */
    public function showAll()
    {
        $data = $this->wxFacts->all()->toJson();
        // dd($data);
        return $data;
    }

    /**
     * Return paginated list of all wx data.
     * @param $page = items per page
     * @param $column = order by column
     * @param $direction = order by direction 
     */
    public function showFiltered($page = 50, $column = 'timestamp', $direction = 'asc')
    {
        $params = Route::current()->parameters();
        $validator = Validator::make($params, [
            'page' => 'integer',
            'column' => 'alpha',
            'direction' => 'alpha|in:asc,desc',
        ]);

        if ($validator->fails()) {
            dd($validator);
        }

        $data = $this->wxFacts
                    ->orderBy($column, $direction)
                    ->paginate($page);
        return $data;
    }

    /**
     * Update the specified resource in the db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $city
     * @param  char(2)  $state
     * @return \Illuminate\Http\Response
     */
    // public function updateCityState()
    public function updateCityState(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'city' => 'required|string',
            'state' => 'required|alpha|size:2',
        ]);

        if ($validator->fails()) {
            dd($validator);
        }

        $wxFacts = $this->wxFacts->findOrFail($request->id);
        $wxFacts->WeatherDetailsCity = $request->city;
        $wxFacts->WeatherDetailsState = $request->state;

        $wxFacts->save();

        return $wxFacts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

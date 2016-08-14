<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HomeWxFacts;

class WxFactsController extends Controller
{   
     /**
     * The wxFacts model instance.
     */
    protected $wxFacts;

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
     * Return All wx data.
     */
    public function showAll()
    {
        $data = $this->wxFacts->all()->toJson();
        // dd($data);
        return $data;
    }

    /**
     * Return paginated list of all wx data.
     */
    public function showFiltered($page = 50, $filter = "", $dir = "asc")
    {
        $data = $this->wxFacts->paginate($page);
        return $data;
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

<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waters = Water::all()->sortBy("area");
        return view('water.index', ['waters'=>$waters]);
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
        $request->merge(['area' => str_replace(",",".",$request->area)]);
        $validator = Validator::make($request->all(),
        [
            'title' => ['required','unique:waters','min:3','max:15'],
            'area' => ['required','numeric','min:1','max:10000'],
            
        ],
        [
            'title.required' => 'Telkinio pavadinimas privalomas',
            'title.unique' => 'Telkinio pavadinimas turi būti unikalus',
            'title.min' => 'Telkinio pavadinimas per trumpas',
            'title.max' => 'Telkinio pavadinimas per ilgas',
            
            'area.required' => 'Telkinio plotas privalomas',
            'area.numeric' => 'Telkinio plotas turi būti išreikštas skaičiumi',
            'area.min' => 'Telkinio plotas per mažas',
            'area.max' => 'Telkinio plotas per didelis',


        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $water = new Water();
        $water->title = $request->title;
        $water->area = str_replace(",",".",$request->area);
        $water->about = $request->about;
        $water->save();
        return redirect()->route('waters.index')->with('info_message','Vandens telkinys sukurtas sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function show(Water $water)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function edit(Water $water)
    {
        return view('water.edit',['water'=>$water]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Water $water)
    {
        $request->merge(['area' => str_replace(",",".",$request->area)]);
        $validator = Validator::make($request->all(),
        [
            'title' => ['required','min:3','max:15'],
            'area' => ['required','numeric','min:1','max:10000'],
            
        ],
        [
            'title.required' => 'Telkinio pavadinimas privalomas',
            'title.min' => 'Telkinio pavadinimas per trumpas',
            'title.max' => 'Telkinio pavadinimas per ilgas',
            
            'area.required' => 'Telkinio plotas privalomas',
            'area.numeric' => 'Telkinio plotas turi būti išreikštas skaičiumi',
            'area.min' => 'Telkinio plotas per mažas',
            'area.max' => 'Telkinio plotas per didelis',


        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

            $t = Water::where('title',$request->title)->first();
            
            if ($t == $water || $t == null) {
                $water->title = $request->title;
                $water->area = str_replace(",",".",$request->area);
                $water->about = $request->about;
                $water->update();
                return redirect()->route('waters.index')->with('info_message','Informacija apie vandens telkinį pakeista sėkmingai');
             }
            
            
            else {
                return redirect()->back()->withErrors('Telkinys tokiu pavadinimu jau egzistuoja');
                }
                
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function destroy(Water $water)
    {
        $water->delete();
        return redirect()->route('waters.index');
    }
}

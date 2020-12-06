<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all()->sortBy("name");
        $waters = Water::all()->sortBy("title");
        return view('members.index',['members'=>$members, 'waters'=>$waters]);
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
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','alpha','min:3','max:10'],
            'surname' => ['required','alpha','min:3','max:20'],
            'address' => ['required','min:3','max:50'],
            'experience' => ['required','numeric','min:0','max:90'],
            'registered' => ['required','numeric','min:0','max:50','lte:experience'],
        ],
        [
            'name.required' => 'Nario vardas privalomas',
            'name.alpha' => 'Nario vardas turi būti sudarytas tik iš raidžių',
            'name.min' => 'Nario vardas per trumpas',
            'name.max' => 'Nario vardas per ilgas',
            
            'surname.required' => 'Nario vardas privalomas',
            'surname.alpha' => 'Nario vardas turi būti sudarytas tik iš raidžių',
            'surname.min' => 'Nario vardas per trumpas',
            'surname.max' => 'Nario vardas per ilgas',

            'address.required' => 'Vietovė privaloma',
            'address.min' => 'Vietovės pavadinimas per trumpas mturi būti bent 3 simboliai',
            'address.max' => 'Vietovės pavadinimas per ilgas, gali būti ne daugiau, kaip 50 simbolių',

            'experience.required' => 'Patirities trukmė metais privaloma',
            'experience.numeric' => 'Patirities trukmė turi būti išreikšta skaičiumi',
            'experience.min' => 'Trumpiausia patirtis 0 metų',
            'experience.max' => 'Ilgiausia patirtis 90 metų',

            'registered.required' => 'Registracijos trukmė metais privaloma',
            'registered.numeric' => 'Registracijos trukmė turi būti išreikšta skaičiumi',
            'registered.min' => 'Trumpiausia registracijos trukmė 0 metų',
            'registered.max' => 'Ilgiausia registracijos trukmė 50 metų',
            'registered.lte' => 'Registracijos trukmė neturi būti didesnė už patirties trukmę metais',

        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $member = new Member();
        $member->name = $request->name;
        $member->surname = $request->surname;
        $member->address = $request->address;
        $member->experience = $request->experience;
        $member->registered = $request->registered;
        $member->water_id = $request->water_id;
        $member->save();
        return redirect()->route('member.index')->with('info_message','Naujas narys pridėtas sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $waters = Water::all();
        return view('members.edit',['member'=>$member, 'waters'=>$waters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','alpha','min:3','max:10'],
            'surname' => ['required','alpha','min:3','max:20'],
            'address' => ['required','min:3','max:50'],
            'experience' => ['required','numeric','min:0','max:90'],
            'registered' => ['required','numeric','min:0','max:50','lte:experience'],
        ],
        [
            'name.required' => 'Nario vardas privalomas',
            'name.alpha' => 'Nario vardas turi būti sudarytas tik iš raidžių',
            'name.min' => 'Nario vardas per trumpas',
            'name.max' => 'Nario vardas per ilgas',
            
            'surname.required' => 'Nario vardas privalomas',
            'surname.alpha' => 'Nario vardas turi būti sudarytas tik iš raidžių',
            'surname.min' => 'Nario vardas per trumpas',
            'surname.max' => 'Nario vardas per ilgas',

            'address.required' => 'Vietovė privaloma',
            'address.min' => 'Vietovės pavadinimas per trumpas mturi būti bent 3 simboliai',
            'address.max' => 'Vietovės pavadinimas per ilgas, gali būti ne daugiau, kaip 50 simbolių',

            'experience.required' => 'Patirities trukmė metais privaloma',
            'experience.numeric' => 'Patirities trukmė turi būti išreikšta skaičiumi',
            'experience.min' => 'Trumpiausia patirtis 0 metų',
            'experience.max' => 'Ilgiausia patirtis 90 metų',

            'registered.required' => 'Registracijos trukmė metais privaloma',
            'registered.numeric' => 'Registracijos trukmė turi būti išreikšta skaičiumi',
            'registered.min' => 'Trumpiausia registracijos trukmė 0 metų',
            'registered.max' => 'Ilgiausia registracijos trukmė 50 metų',
            'registered.lte' => 'Registracijos trukmė neturi būti didesnė už patirties trukmę metais',

        ]);
            if($validator->fails()){
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $member->name = $request->name;
        $member->surname = $request->surname;
        $member->address = $request->address;
        $member->experience = $request->experience;
        $member->registered = $request->registered;
        $member->water_id = $request->water_id;
        $member->update();
        return redirect()->route('member.index')->with('info message','Nario informacija sėkmingai atnaujinta');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('info message', 'Narys ištrintas sėkmingai');
    }
    public function sort(Request $request)
    {
        if ($request->water_id == 'all'){
            return redirect()->route('member.index');
        }
        else {
           $waters = Water::all()->sortBy("area");
        $id = $request->water_id;
        $members = Member::where('water_id', '=', $id)-> get();

        return view('members.index', ['waters'=>$waters,'members'=>$members]);
        
        }
        
    }
}

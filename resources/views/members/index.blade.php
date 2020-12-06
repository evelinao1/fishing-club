<?php
use App\Models\Water;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Žvejai</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-green-300">
    <div class="grid grid-cols-12 gap-4 mt-20">
        <div class="col-start-7 col-span-1">
            <a href="{{ route('waters.index') }}">Rodyti telkinius</a>
        </div>
        <div class="col-start-8 col-span-1">
            <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                            {{ __('Logout') }}
                                        </a>
            </form>
        </div>
        <div class="col-start-9 col-span-2">
            <img src="{{asset('pic/fishopsm.png')}}" alt="fish logo">
        </div>
    </div>
    
    
    <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-start-5 col-span-5">
                    @if ($errors->any())
                        <div class="text-red-500">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    @if(session()->has('info_message'))
                        <div class="text-green-900">
                            {{session()->get('info_message')}}
                        </div>
                    @endif            
                        
            </div>
    </div>           
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5 lg:col-start-7">
            <form action="{{route('member.sort')}}" method="get">
                <label id="pusher" for="cars">Rodyti narius, kurie naudojasi telkiniu:</label>
                <select name="water_id" id="water_id" class="bg-green-200 rounded-md">
                    <option  value="all">Visi</option>
                    @foreach ($waters as $water)
                    <option  value="{{$water->id}}">{{$water->title}}</option>
                    @endforeach

                </select>
                <x-jet-button class="ml-4">
                                    {{ __('Pasirinkti') }}
                                </x-jet-button>
                @csrf
            </form> 
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-10">
        <div class="col-start-2 col-span-5 ">
                <p class="text-xl mb-5">Sukurti naują narį</p>
                <form action="{{route('member.store')}}" method="post">
                <label class="fill-label" for="name">Vardas:</label>
                <input class="bg-green-200 rounded-md fill-input" type="name" id="name" name="name" value="{{ old('name') }}"><br>
                <label class="fill-label" for="surname">Pavardė:</label>
                <input class="bg-green-200 rounded-md fill-input" type="surname" id="surname" name="surname" value="{{ old('surname') }}"><br>
                <label class="fill-label" for="address">Vietovė:</label>
                <input class="bg-green-200 rounded-md fill-input" type="address" id="address" name="address" value="{{ old('address') }}"><br>
                <label class="fill-label" for="experience">Patirtis metais:</label>
                <input class="bg-green-200 rounded-md fill-input" type="experience" id="experience" name="experience" value="{{ old('experience') }}"><br>
                <label class="fill-label" for="registered">Narystės trukmė klube metais:</label>
                <input class="bg-green-200 rounded-md fill-input" type="registered" id="registered" name="registered" value="{{ old('registered') }}"><br>
                <label class="fill-label" for="water_id">Vandens telkinys:</label><br>
                <select class="bg-green-200 rounded-md"id="water_id" name="water_id">
                    <?php foreach ($waters as $water){ 
                        
                    ?>
                    
                    <option value="<?=$water->id?>"><?php echo $water->title?></option>
                <?php }?>
                </select>      
                <x-jet-button class="ml-4">
                                {{ __('Sukurti') }}
                            </x-jet-button>
                    @csrf
                </form>
            </div>

        <div class="col-start-2 col-span-5 lg:col-start-7">
            <table class="table-auto bg-green-200 rounded-md">
                <p class="text-xl mb-5">Visi klubo nariai</p>
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">Vardas</th>
                    <th class="px-2 py-2">Pavardė</th>
                    <th class="px-2 py-2">Vietovė</th>
                    <th class="px-2 py-2">Patirtis metais</th>
                    <th class="px-2 py-2">Klubo narystės laikas metais</th>
                    <th class="px-2 py-2">Vandens telkinys</th>
                </thead>
                
                @foreach ($members as $member)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$member->name}}</td>
                    <td class="border px-2 py-1">{{$member->surname}}</td>
                    <td class="border px-2 py-1">{{$member->address}}</td>
                    <td class="border px-2 py-1">{{$member->experience}}</td>
                    <td class="border px-2 py-1">{{$member->registered}}</td>
                    <td class="border px-2 py-1">{!!Water::where('id', '=', $member->water_id)->value('title')!!}</td>
                    <td class="border px-2 py-1"></form><form action="{{route('member.edit',$member)}}" method="get">
                            <button type="submit">Redaguoti</button>
                    <td class="border px-2 py-1"></form><form action="{{route('member.destroy',$member)}}" method="post">
                            <button type="submit">Trinti</button>
                            @csrf
                            </form></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
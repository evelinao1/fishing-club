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
            <a href="{{ route('member.index') }}">Rodyti žvejus</a>
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
            <img src="pic/fishopsm.png" alt="fish logo">
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
        <div class="col-start-2 col-span-5 ">
                <p class="text-xl mb-5">Sukurti naują vandens telkinį</p>
                <form action="{{route('waters.store')}}" method="post">
                <label class="fill-label" for="title">Pavadinimas:</label>
                <input class="bg-green-200 rounded-md fill-input" type="title" id="title" name="title" value="{{ old('title') }}"><br>
                <label class="fill-label" for="area">Užimamas plotas:</label>
                <input class="bg-green-200 rounded-md fill-input" type="area" id="area" name="area" value="{{ old('area') }}"><br>
                <label class="fill-label" for="about">Apibūdinimas:</label>
                <textarea class="bg-green-200 rounded-md fill-input" rows="4" cols="50" name="about">Apibūdinimas</textarea><br>            
                <x-jet-button class="ml-4">
                                {{ __('Sukurti') }}
                            </x-jet-button>
                    @csrf
                </form>
            </div>

        <div class="col-start-2 col-span-5 lg:col-start-7">
            <table class="table-auto bg-green-200 rounded-md">
                <p class="text-xl mb-5">Visi vandens telkiniai</p>
                <thead>
                
                    <tr>
                    <th class="px-2 py-2">Pavadinimas</th>
                    <th class="px-2 py-2">Užimamas plotas</th>
                    <th class="px-2 py-2">Kita informacija</th>
                </thead>
                
                @foreach ($waters as $water)
                
                <tbody>
                    <tr>
                    <td class="border px-2 py-1">{{$water->title}}</td>
                    <td class="border px-2 py-1">{{$water->area}}</td>
                    <td class="border px-2 py-1">{{$water->about}}</td>
                    <td class="border px-2 py-1"></form><form action="{{route('waters.edit',$water)}}" method="get">
                            <button type="submit">Redaguoti</button>
                    <td class="border px-2 py-1"></form><form action="{{route('waters.destroy',$water)}}" method="post">
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
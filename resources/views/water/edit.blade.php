<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishing</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-green-300">
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
        </div>
</div>            
<div class="grid grid-cols-12 gap-4 mt-5">
    <div class="col-start-5 col-span-5">
        <p class="text-2xl">Pakeisti informaciją apie vandens telkinį</p>
        <form action="{{route('waters.update', $water)}}" method="post">
        <label for="title">Vardas:</label><br>
        <input class="bg-green-200 rounded-md" type="title" id="title" name="title" value="{{old('title', $water->title)}}"><br><br>
        <label for="area">Užimamas plotas:</label><br>
        <input class="bg-green-200 rounded-md" type="area" id="area" name="area" value="{{old('area', $water->area)}}"><br><br>
        <label for="about">Apibūdinimas:</label><br>
        <textarea class="bg-green-200 rounded-md" rows="4" cols="50" name="about">{{$water->about}}</textarea>
        
        
        <x-jet-button class="ml-4">
                        {{ __('Pakeisti') }}
                    </x-jet-button>
            @csrf
        </form>
    </div>
</div>

</body>
</html>
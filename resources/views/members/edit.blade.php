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
        <p class="text-2xl">Pakeisti informaciją apie narį</p>
        <form action="{{route('member.update',$member)}}" method="post">
                <label class="fill-label" for="name">Vardas:</label>
                <input class="bg-green-200 rounded-md fill-input" type="name" id="name" name="name" value="{{ old('name', $member->name) }}"><br>
                <label class="fill-label" for="surname">Pavardė:</label>
                <input class="bg-green-200 rounded-md fill-input" type="surname" id="surname" name="surname" value="{{ old('surname', $member->surname) }}"><br>
                <label class="fill-label" for="address">Vietovė:</label>
                <input class="bg-green-200 rounded-md fill-input" type="address" id="address" name="address" value="{{ old('address', $member->address) }}"><br>
                <label class="fill-label" for="experience">Patirtis metais:</label>
                <input class="bg-green-200 rounded-md fill-input" type="experience" id="experience" name="experience" value="{{ old('experience', $member->experience) }}"><br>
                <label class="fill-label" for="registered">Narystės trukmė klube metais:</label>
                <input class="bg-green-200 rounded-md fill-input" type="registered" id="registered" name="registered" value="{{ old('registered', $member->registered) }}"><br>
                <label class="fill-label" for="water_id">Vandens telkinys:</label><br>
                <select class="bg-green-200 rounded-md"id="water_id" name="water_id">
                    <?php foreach ($waters as $water){ 
                        
                    ?>
                    
                    <option value="<?=$water->id?>"><?php echo $water->title?></option>
                <?php }?>
                </select>      
                <x-jet-button class="ml-4">
                                {{ __('Pakeisti') }}
                            </x-jet-button>
                    @csrf
                </form>
    </div>
</div>

</body>
</html>
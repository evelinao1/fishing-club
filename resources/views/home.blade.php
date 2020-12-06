<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Žvejyba</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-green-300">

    <div class="grid grid-cols-12 gap-4 mt-20">
        <div class="col-start-3 col-span-2 mt-20">
            <img src="pic/fish.png" alt="fish logo">
        </div>
        <div class="col-start-5 col-span-2 mt-20">
            <h1 class="font-semibold text-3xl text-center">Žvejai</h1>
        </div>
        <div class="col-start-7 col-span-2 mt-20">
            <img src="pic/fishop.png" alt="fish logo">
        </div>
    </div> 
    <div class="grid grid-cols-12 gap-4 mt-20">   
        
        @if (Route::has('login'))
               
                    @auth
                    <div class="col-start-5 col-span-1">
                        <a href="{{ url('/members') }}" class="text-sm text-gray-700 underline">Nariai</a>
                    </div>
                    <div class="col-start-6 col-span-2">    
                        <a href="{{ url('/water') }}" class="text-sm text-gray-700 underline">Vandens telkiniai</a>
                    </div>    
                    @else
                    <div class="col-start-5 col-span-1">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                        </div>
                        @if (Route::has('register'))
                        <div class="col-start-6 col-span-2"> 
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        </div>
                        @endif
                    @endif
                </div>
            @endif
            </div>
    </div>

</body>
</html>
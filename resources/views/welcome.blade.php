<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel api</title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="rounded-lg border-4 border-dashed border-gray-200 p-4 flex flex-row space-x-2">
                        <div class="bg-white rounded-md flex flex-row items-center p-2 w-[400px]">
                            <div class="flex flex-col items-center">
                                <div class="flex flex-row items-center">
                                    <img class="flex h-12 w-12 rounded m-0" src="{{$forecast->current->condition->icon}}" alt="">
                                    <p class="font-bold text-3xl ml-2 text-slate-900">{{$forecast->current->temp_c}} °C</p>
                                </div>
                                <p class="text-sm text-slate-500">{{$forecast->current->condition->text}}</p>
                            </div>
                            <div class="flex flex-col ml-4">
                                <p class="text-xs text-slate-500">Clouds: {{$forecast->current->cloud}}%</p>
                                <p class="text-xs text-slate-500">Humidity: {{$forecast->current->humidity}}%</p>
                                <p class="text-xs text-slate-500">Wind: {{$forecast->current->wind_kph}} km/h</p>
                            </div>
                            <div class="flex-1"></div>
                            <div class="flex flex-col items-end ml-4">
                                <p class="text-xl text-slate-900">{{ $forecast->location->name }}, {{ $forecast->location->country }}</p>
                                <p class="text-sm text-slate-500">{{ array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday')[date('w', $forecast->location->localtime_epoch )] }}</p>
                            </div>
                        </div>
                        @foreach($forecast->forecast->forecastday as $day)
                        <div class="bg-white rounded-md flex flex-col items-center p-2">
                            <p class="text-sm text-slate-500">{{ array('Sun', 'Mon', 'Tue', 'Wed','Thu','Fri', 'Dat')[date('w', $day->date_epoch )] }}</p>
                            <img class="flex h-12 w-12 rounded m-0" src="{{$day->day->condition->icon}}" alt="">
                            <div class="flex flex-row">
                                <p class="text-xs text-slate-700">{{ round($day->day->maxtemp_c) }}°</p>
                                <p class="text-xs text-slate-400 ml-1">{{ round($day->day->mintemp_c) }}°</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
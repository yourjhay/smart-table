<?php
namespace App\Controllers;
    
Use Simple\Request;
    
class WeatherController extends Controller 
{
    
    public function index() 
    {

        $weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?id=1720148&appid=16ffbab890d3c0b3763cc1edb08abb91');
        $data = json_decode($weather, true);
      
        return view('weather',[
            'data'=>$data,
            'temp'=> self::k_to_c($data['main']['temp'])]);
    }


    function k_to_c($temp) {
        if ( !is_numeric($temp) ) { return false; }
        return round(($temp - 273.15));
    }
    
}
<?php

namespace App\Controllers;

use App\Entities\City;
use App\Entities\Weather;
use App\Models\CityModel;
use App\Models\WeatherModel;
use Exception;

class Cronjobs extends BaseController
{
    const api_key = '5fc76e4e480f83af65d8a53832008827';
    const units = 'metric';

    public function getCitiesWeatherData(){
        try{
            $cityModel = new CityModel();
            $weatherModel = new WeatherModel();

            /** @var City[] $cities */
            $cities = $cityModel->findAll();

            if($cities){
                foreach ($cities as $city){
                    $data = $this->getWeatherData($city);

                    if($data){
                        $weather = new Weather();
                        $weather->city_id = $city->id;
                        $weather->temperature = $data->main->temp ?? '';
                        $weather->humidity = $data->main->humidity ?? '';
                        $weather->windspeed = $data->wind->speed ?? '';

                        if (!$weather->checkIsValidSave()) continue;

                        $weatherModel->insert($weather);
                        if (!empty($weatherModel->errors())) throw new Exception($weatherModel->getErrorsAsString());
                    } else {
                        throw new Exception('Nem érkeztek adatok. Város azonosító: '. $city->id);
                    }
                }
            }

        } catch (Exception $e){
            log_message('error', $e->getMessage());
        }
    }

    protected function getWeatherData($city)
    {
        try {
            if($city){
                //$url = "https://api.openweathermap.org/data/2.5/weather?q={$city->name}&appid=".self::api_key;
                $url = "https://api.openweathermap.org/data/2.5/weather?lat={$city->latitude}&lon={$city->longitude}&units=" . self::units . "&appid=" . self::api_key;
                $response = file_get_contents($url);
                return json_decode($response);
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

}
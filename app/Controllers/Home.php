<?php

namespace App\Controllers;

use App\Entities\City;
use App\Models\CityModel;
use Exception;

class Home extends BaseController
{

    public function index(): string
    {
        return view('cities');
    }

    public function saveCity(){
        try{

            if (!$this->request->isAJAX()) {
                throw new Exception('Az oldal ajax kéréssel érhető el.');
            }

            $id = $this->request->getVar('id', FILTER_SANITIZE_NUMBER_INT);
            $name = $this->request->getVar('name', FILTER_SANITIZE_SPECIAL_CHARS);
            $latitude = (double)$this->request->getVar('latitude', FILTER_SANITIZE_SPECIAL_CHARS);
            $longitude = (double)$this->request->getVar('longitude', FILTER_SANITIZE_SPECIAL_CHARS);

            $cityModel = new CityModel();

            if($id){
                $city = $cityModel->find($id);
                if(!$city) throw new Exception('A keresett város nem található az adatbázisban!');
            } else {
                $city = new City();
            }

            $city->name = $name;
            $city->latitude = $latitude;
            $city->longitude = $longitude;

            if (!$city->checkIsValidSave()) throw new Exception($city->getErrorsAsString());

            $id ? $cityModel->update($city->id, $city) : $id = $cityModel->insert($city);
            if (!empty($cityModel->errors())) throw new Exception($cityModel->getErrorsAsString());

            $data = $cityModel->find($id);

            $response = ['type' => 'success', 'data' => $data];
        } catch (Exception $e){
            log_message('error', $e->getMessage());
            $response = ['type' => 'error', 'body' => $e->getMessage()];
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function deleteCity(){
        try{
            if (!$this->request->isAJAX()) {
                throw new Exception('Az oldal ajax kéréssel érhető el.');
            }

            $id = $this->request->getVar('id', FILTER_SANITIZE_NUMBER_INT);

            $cityModel = new CityModel();
            $cityModel->delete($id);

            $response = ['type' => 'success'];
        } catch (Exception $e){
            log_message('error', $e->getMessage());
            $response = ['type' => 'error', 'body' => $e->getMessage()];
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function getCityTableData(){
        try{
            if (!$this->request->isAJAX()) {
                throw new Exception('Az oldal ajax kéréssel érhető el.');
            }

            $cityModel = new CityModel();
            $data = $cityModel->findAll();

            $response = ['type' => 'success', 'data' => $data];
        } catch (Exception $e){
            log_message('error', $e->getMessage());
            $response = ['type' => 'error', 'body' => $e->getMessage()];
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

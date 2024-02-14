<?php

namespace App\Models;

use App\Entities\Weather;
use CodeIgniter\Entity\Cast\ObjectCast;
use CodeIgniter\Model;

class WeatherModel extends Model
{
    protected $table = 'weathers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = Weather::class;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'city_id',
        'temperature',
        'humidity',
        'windspeed',
    ];

    protected $useTimestamps = true;

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation = true;

    public array $errors = [];

    public function getHourlyWeatherByCityID($id){

        $to = date('Y-m-d H:i:s', time());
        $from = date('Y-m-d H:i:s',time() - 60 * 60 * 24); // -24 hours

        $sql = "SELECT  cities.name AS 'city_name', weathers.*
        FROM weathers 
            LEFT JOIN cities ON cities.id = weathers.city_id
        WHERE weathers.created_at < ? AND weathers.created_at > ? AND weathers.city_id = ?
        GROUP BY HOUR(weathers.created_at)";

        $params = [$to, $from, $id];
        $query = $this->db->query($sql, $params);

        return $query->getResult(ObjectCast::class);
    }

    public function getErrorsAsString(): string {

        if (is_array($this->errors())) {
            return implode(', ', $this->errors());
        }

        return (string)$this->errors();
    }
}
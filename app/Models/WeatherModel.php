<?php

namespace App\Models;

use App\Entities\Weather;
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

    public function getErrorsAsString(): string {

        if (is_array($this->errors())) {
            return implode(', ', $this->errors());
        }

        return (string)$this->errors();
    }
}
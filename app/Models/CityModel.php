<?php

namespace App\Models;

use App\Entities\City;
use Closure;
use CodeIgniter\BaseModel;
use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = City::class;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'name',
        'latitude',
        'longitude',
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
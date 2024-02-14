<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Class Weather
 * @property integer id
 * @property integer city_id Város azonosítója
 * @property double temperature Hőmérséklet
 * @property double humidity Páratartalom (%)
 * @property double windspeed Szélsebesség
 * @package App\Entities
 */
class Weather extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
        'temperature' => 'double',
        'humidity' => 'double',
        'windspeed' => 'double',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected array $errors = [];

    public function checkIsValidInsert(): bool
    {
        if (empty($this->city_id)) {
            $this->errors['city_id'] = 'A város azonosítójának megadása kötelező!';
        }

        return empty($this->errors);
    }

    public function checkIsValidUpdate(): bool {
        $this->errors = [];

        $this->checkIsValidInsert();

        if (empty($this->id)) {
            $this->errors['id'] = 'Missing database ID!';
        }

        return empty($this->errors);
    }

    public function checkIsValidSave(): bool {

        if (empty($this->id)) {
            return $this->checkIsValidInsert();
        } else {
            return $this->checkIsValidUpdate();
        }
    }

    public function getErrorsAsString(): string {
        return implode(', ', $this->errors);
    }
}
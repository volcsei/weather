<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Class City
 * @property integer id
 * @property integer name Város neve
 * @property double longitude Hosszúsági fok
 * @property double latitude Szélességi fok
 * @package App\Entities
 */
class City extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'name' => 'varchar',
        'longitude' => 'double',
        'latitude' => 'double',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected array $errors = [];

    public function checkIsValidInsert(): bool
    {
        if (empty($this->name)) {
            $this->errors['name'] = 'A városnév megadása kötelező!';
        }

        if (strlen($this->name) > 255) {
            $this->errors['name'] = 'A városnév túl hosszú, legfeljebb 255 karakter!';
        }

        if (empty($this->longitude)) {
            $this->errors['longitude'] = 'A hosszúsági fok megadása kötelező!';
        }

        if ($this->longitude > 180 || $this->longitude < -180) {
            $this->errors['longitude'] = 'A hosszúsági fok nem megfelelő!';
        }

        if (empty($this->latitude)) {
            $this->errors['latitude'] = 'A szélességi fok megadása kötelező!';
        }

        if ($this->latitude > 90 || $this->latitude < -90) {
            $this->errors['latitude'] = 'A szélességi fok nem megfelelő!';
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
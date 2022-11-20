<?php

namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
    public function setPassword(string $pass)
    {
        $status = uniqid('', true);
        $this->attributes['status'] = $status;
        $this->attributes['password'] = md5($status . $pass);

        return $this;
    }
}

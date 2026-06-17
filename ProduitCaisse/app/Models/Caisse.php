<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class Caisse extends Model
    {
        protected $table = 'caisse';
        protected $primaryKey = 'id';
        protected $allowedFields = ['numero_caisse'];

    }


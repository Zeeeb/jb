<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model{

    protected $table='cym_bank';

    public $timestamps=true;

    protected function getDateFormat()
    {
        return parent::getDateFormat(); // TODO: Change the autogenerated stub
    }

    public function asDateTime($value)
    {
        return parent::asDateTime($value); // TODO: Change the autogenerated stub
    }
}
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model{

    protected $table='cym_offer';

    public $timestamps=true;

    protected function getDateFormat()
    {
        return parent::getDateFormat(); // TODO: Change the autogenerated stub
    }

    protected function asDateTime($value)
    {
        return parent::asDateTime($value); // TODO: Change the autogenerated stub
    }

}
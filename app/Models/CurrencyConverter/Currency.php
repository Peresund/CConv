<?php

namespace App;

class Currency
{
    protected $fillable = [
        'iso_4217', 'name', 'date_created', 'date_modified', 'rate'
    ];
}

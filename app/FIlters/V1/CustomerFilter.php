<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

 //query constaint
 class CustomerFilter extends ApiFilter {
    protected $safeParms =[
        'name' => ['eq'],
        'type' => ['eq'],
        'email' =>['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    //translate to table column
    protected $columnMap =[
        'postalCode' => 'postal_code'
    ];

    //opertor signs

    protected $operatorMap =[
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
     'gt' => '>',
     'gte' => '>='
    ];


 }


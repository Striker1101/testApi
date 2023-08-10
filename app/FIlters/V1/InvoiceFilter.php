<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

 //query constaint
 class InvoiceFilter extends ApiFilter {

    protected $safeParms =[
        'CustomerId' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'lte', 'gte' ],
        'status' =>['eq', 'ne'],
        'billedDate' => ['eq', 'lt', 'gt', 'lte', 'gte' ],
        'payedDate' => ['eq', 'lt', 'gt', 'lte', 'gte' ],
    ];

    //translate to table column
    protected $columnMap =[
        'CustomerId' => 'Customer_id',
        'billedDate' => 'billed_date',
        'payedDate' => 'payed_date'
    ];

    //opertor signs

    protected $operatorMap =[
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
     'gt' => '>',
     'gte' => '>=',
     'ne' => '!='
    ];
 }


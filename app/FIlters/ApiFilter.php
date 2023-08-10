<?php

namespace App\Filters;

use Illuminate\Http\Request;

 //query constaint
 class ApiFilter {
    protected $safeParms =[

    ];

    //translate to table column
    protected $columnMap =[

    ];

    //opertor signs

    protected $operatorMap =[
    
    ];

    /**
     * transforming the request query into
     */
    public function transform( Request $request){

        //array passed to eloquent
        $eloQuery = [];

        foreach($this ->safeParms as $parm =>$operators){

            $query = $request-> query($parm);

            //if query is empthy
            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator){

                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];

                }
            }

        }

        return $eloQuery;
    }
 }


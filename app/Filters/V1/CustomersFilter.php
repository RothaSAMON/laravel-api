<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {
    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    // public function transform(Request $request) {
    //     $eloQuery = [];

    //     foreach ($this->safeParms as $parm => $operators) {
    //         $query = $request->query($parm);

    //         if (!isset($query)) {
    //             continue;
    //         }

    //         $column = $this->columnMap($parm) ?? $parm;

    //         foreach ($operators as $operators) {
    //             if (isset($query[$operators])) {
    //                 $eloQuery[] = [$column, $this->operatorMap($operators), $query[$operators]];
    //             }
    //         }
    //     }
    // } 

    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            // Use array instead of method call
            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    // Use array instead of method call
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;
use App\Filters\V1\CustomerFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {

        $filter = new CustomerFilter();
        $FilterItems = $filter->transform($request); //[['column', 'operator','value]]


        $includeInvoice = $request->query('includeInvoices');

        $customers = Customer::where($FilterItems);

        if($includeInvoice){
        $customers = $customers->with('invoices');
        };

         return new CustomerCollection($customers ->paginate()-> appends($request -> query()));
        //return all customer in db
         //all would provide all your data
         //paginate is also available

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
          // Remove the 'postalCode' key from the request data
    $requestData = $request->except('postalCode');


    // Create a new customer using the modified request data
    $customer = Customer::create($requestData);

    return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        $includeInvoice = request()->query('includeInvoices');
        if($includeInvoice){

            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

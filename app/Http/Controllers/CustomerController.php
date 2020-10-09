<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:customers',
            'password' => 'required|string',
            'address' => 'required|string|min:3|max:255',
            'mobile' => 'required|string',
        ]);

        $customer = new Customer;

        try{
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = $request->password;
            $customer->address = $request->address;
            $customer->mobile = $request->mobile;
            $customer->save();
            return response(['message'=> "Successfully saved!", 'customer' => $customer]);
        }catch(Exception $e){
            return response(['error' => $e]);
        }

    }

    public function getAllCustomer(){
        $customers = Customer::all();
        return response()->json(['message' => "All customers" ,'customers' => $customers],200);
    }

    public function getCustomerById($id){
        $customer = Customer::find($id);
        return response(['customer' => $customer]);
    }

    public function delete(Request $request) {
        
        $customer = Customer::find($request->input('customer_id'));

        if($customer == null){
            return response(['message' => "Customer id not found!"]);
        }
        $customer->delete();
        return response(['message' => "Customer deleted successfully!"]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'address' => 'required|string|min:3|max:255',
            'mobile' => 'required|string',
        ]);


        $customer = Customer::find($request->id);


        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->save();

        return response(['message' => "Customer updated successfully!", 'customer' => $customer]);
    }
}

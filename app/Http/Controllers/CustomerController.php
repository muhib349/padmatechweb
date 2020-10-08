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
            'password' => 'required|string|confirmed',
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
        return response(['message' => "All customers" ,'customers' => $customers]);
    }
}

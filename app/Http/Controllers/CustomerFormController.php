<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerFormController extends Controller {
    public function index() {
        $url = url( '/customer/create' );
        $title = 'Customer Registration';
        $form_submit_text = 'Submit';
        $customer = ( object ) array(
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'country' => '',
            'state' => '',
            'state' => '',
            'customer_image' => "",
            'address' => '',
            'gender' => '',
            'dob' => ''
        );
        $form_status = 'new';

        $data = compact( 'customer', 'url', 'title', 'form_submit_text', 'form_status' );
        return view( 'customer' )->with( $data );
    }

    public function store( Request $request ) {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:customers,email',
                'password' => 'required|min:6|alpha_dash',
                // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirm_password' => 'required|same:password',
                'country' => 'required',
                'state' => 'required',
                'state' => 'required',
                'address' => 'required',
                'customer_image' => 'required|mimes:png,jpg,jpeg|max:500',
                'gender' => 'required|in:M,F,O',
                'dob' => 'required|date_format:Y-m-d|before:today|nullable',
            ]
        );

        // File name
        $fileName = time().'-image.' . $request->file('customer_image')->getClientOriginalExtension();
        // $file_storage = array(
        //     'fileName' => $fileName,
        //     'Original' => $request->file('customer_image')->GetClientOriginalName(),
        // );
        // Upload image
        $path = $request->file('customer_image')->storeAs('public/uploads', $fileName );
        // $path = $fileName->storeAs('files', $name, 'public');


        $customer = new Customer;

        // MOdel throw insert data
        $customer->name = $request[ 'name' ];
        $customer->email = $request[ 'email' ];
        $customer->gender = $request[ 'gender' ];
        $customer->address = $request[ 'address' ];
        $customer->state = $request[ 'state' ];
        $customer->country = $request[ 'country' ];
        $customer->customer_image = $fileName;
        $customer->dob = $request[ 'dob' ];
        $customer->password = md5( $request[ 'password' ] );
        $customer->save();

        return redirect( '/customer' );
    }

    public function view(Request $request) {

        $search = $request['search'] ?? '';


        if($search != ''){
            // where

            $customers = Customer::where('name', 'LIKE', "%$search%")->orderBy('created_at','desc')->orWhere('email', 'LIKE', "%$search%")->paginate(50);
            $customers->appends(['search' => $search]); // search with pagination
        }else{
            $customers = Customer::orderBy('created_at','desc')->paginate(50);
        }

        // print_r( $customers->toArray() );

        $data = compact( 'customers', 'search' );
        return view( 'customer-view' )->with( $data );
    }

    public function trash() {

        $customers = Customer::onlyTrashed()->paginate(5);

        $data = compact( 'customers' );
        return view( 'customer-trash' )->with( $data );
    }

    public function restore( $id ) {
        $customer = Customer::withTrashed()->find( $id );
        if ( !is_null( $customer ) ) {
            $customer->restore();
        }
        // return redirect()->back();
        return redirect( 'customer' );
    }

    public function delete( $id ) {

        $customer = Customer::find( $id );
        if ( !is_null( $customer ) ) {
            $customer->delete();
        }
        // return redirect()->back();
        return redirect( 'customer' );
    }

    public function forceDelete( $id ) {

        $customer = Customer::withTrashed()->find( $id );
        if ( !is_null( $customer ) ) {

            // delete old one
            $filePath = public_path('storage\uploads');

            // After the Image has been updated then we can delete the old Image if exists
            if(!is_null($customer->customer_image)){

                if (file_exists($filePath.'/'.$customer->customer_image)){
                    @unlink($filePath.'/'.$customer->customer_image);
                }
            }

            $customer->forceDelete();
        }

        return redirect()->back();
    }

    public function edit( $id ) {

        $customer = Customer::find( $id );
        if ( !is_null( $customer ) ) {

            $url = url( '/customer/update' ) . '/' . $id ;
            $title = 'Update Customer';
            $form_submit_text = 'update';
            $form_status = 'edit';

            $data = compact( 'customer', 'url', 'title', 'form_submit_text', 'form_status' );
            return view( 'customer' )->with( $data );
        } else {
            return redirect( 'customer' );
        }
    }

    public function statusChange( Request $request ) {

        // if ( $request->header( 'Authorization' ) ) {

        // }

        if ( $request->ajax() ) {

            $customer = Customer::find( $request->cid );

            if ( !is_null( $customer ) ) {
                // return response()->json( [ 'data'=>$customer ] );

                if ( $customer->status == 0 ) {
                    $customer->status = 1;
                } elseif ( $customer->status == 1 ) {
                    $customer->status = 0;
                }
                $customer->save();

                return response()->json( [
                    'success'=>true,
                    'customerStatus' => $customer->status,
                    'customerName' => $customer->name
                ] );
            } else {
                return response()->json( [
                    'success'=>false,
                    'message' => 'User not found.' ] );
            }
        }
    }

    public function update( $id, Request $request ) {

        // delete old one
        $filePath = public_path('storage\uploads');

        // After the Image has been updated then we can delete the old Image if exists

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:customers,email,'.$id.',customer_id',
                // 'password' => 'required|min:6|alpha_dash',
                // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                // 'confirm_password' => 'required|same:password',
                'country' => 'required',
                'state' => 'required',
                'state' => 'required',
                'address' => 'required',
                'gender' => 'required|in:M,F,O',
                'customer_image' => 'mimes:png,jpg,jpeg|max:500',
                'dob' => 'required|date_format:Y-m-d|before:today|nullable',
            ]
        );

        $customer = Customer::find( $id );


        if ( !is_null( $customer ) ) {


        if($request->file('customer_image')){
            // File name
            $fileName = time().'-image.' . $request->file( 'customer_image' )->getClientOriginalExtension();
            $path = $request->file( 'customer_image' )->storeAs( 'public/uploads', $fileName );

            // delete old one
            $filePath = public_path('storage\uploads');

            // After the Image has been updated then we can delete the old Image if exists
            if(!is_null($customer->customer_image)){

                if (file_exists($filePath.'/'.$customer->customer_image)){
                    @unlink($filePath.'/'.$customer->customer_image);
                }
            }

        }else{
            $fileName = $customer->customer_image;
        }

            // Model throw insert data
            $customer->name = $request[ 'name' ];
            $customer->email = $request[ 'email' ];
            $customer->gender = $request[ 'gender' ];
            $customer->address = $request[ 'address' ];
            $customer->state = $request[ 'state' ];
            $customer->country = $request[ 'country' ];
            $customer->customer_image = $fileName;
            $customer->dob = $request[ 'dob' ];
            $customer->save();

            return redirect( '/customer' );
        }
    }
}

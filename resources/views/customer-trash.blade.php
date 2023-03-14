@extends('layouts.main')
@push('title')
    <title>Customer Trash</title>
@endpush
@section('main-section')
    <div class="container bg-white p-3 rounded">


        <div class="text-left pt-3 rounded-0">
            <button class="btn btn-primary badge badge-danger">Trash List</button>
        </div>
        @if (!$customers->isEmpty())
            <div class="row">
                <div class="col-6">
                    <span><b>Record Count: </b></span><span class="badge badge-warning font-weight-normal">{{ $customers->total() }}</span>
                </div>
                <div class="col-6">
                    @include('pagination', ['customers' => $customers])
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            {{-- <th scope="col"><b>ID</b></th> --}}
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">State</th>
                            <th scope="col">Country</th>
                            <th scope="col" style="width: 10%;">Birthdate</th>
                            <th scope="col" style="width: 10%;">Register Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 13%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($customers as $customer)
                            {{-- @php
                            p($customer);
                        @endphp --}}

                            <tr class="">
                                {{-- <td class="border-top-0  border-left-0 border-right border-primary"><b>{{$num}}</b></td> --}}
                                <td scope="row">
                                    @if ($customer->customer_image != null)
                                    <img src="{{asset("storage/uploads").'/'.$customer->customer_image}}" alt="" class="rounded-circle border border-primary" width="50" height="50">
                                    @else
                                        <img src="{{asset('storage/images')}}/men-dummy.png" alt="" class="rounded-circle border border-primary" width="50" height="50">
                                    @endif
                                </td>
                                <td scope="row">{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if ($customer->gender == 'M')
                                        Male
                                    @elseif($customer->gender == 'F')
                                        Female
                                    @else
                                        Other
                                    @endif
                                </td>
                                <td>{{ $customer->state }}</td>
                                <td>{{ $customer->country }}</td>
                                <td>{{ $customer->dob }}</td>
                                <td>{{ get_formatted_date($customer->created_at, 'd/m g:i A') }}</td>
                                <td>
                                    @if ($customer->status)
                                        <span class="badge badge-success user-status-trash">Active</span>
                                    @else
                                        <span class="badge badge-danger user-status-trash">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('force-customer.delete', ['id' => $customer->customer_id]) }}"><button
                                            class="btn btn-danger p-2 permanent">Delete</button></a>
                                    <a href="{{ route('customer.restore', ['id' => $customer->customer_id]) }}"><button
                                            class="btn btn-primary p-2">Restore</button></a>
                                </td>

                            </tr>
                            @php
                                $num++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($customers->isEmpty())
            <div class="alert alert-info mt-2" role="alert">
                The Trash table is empty.
            </div>
        @endif

    </div>
@endsection

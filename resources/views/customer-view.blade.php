@extends('layouts.main')
@push('title')
    <title>Customer View</title>
@endpush
@section('main-section')
    <div class="container bg-white p-3 rounded">
        <div class="row pt-3 pb-1">
            <div class="col-10">
                <form action="" method="get">
                    <div class="row">
                        <div class="form-group col-md-10 ">
                            <input type="search" name="search" id="search" class="form-control"
                                value="{{ $search }}" placeholder="Search by name or email">
                        </div>
                        <div class="form-group col-md-2  p-0">
                            <button class="btn btn-outline-primary">Search</button>
                        </div>
                    </div>
                </form>
                {{-- <a href="{{url('/customer')}}"><button class="btn btn-outline-success">Reset</button></a> --}}
            </div>
            <div class="col-2 text-right">
                <a href="{{ route('customer.trash') }}" class="btn btn-danger">Go to trash</a>
                <a href="{{ route('customer.create') }}" class="btn btn-primary">Add</a>
            </div>
        </div>
        <hr>

        @if (!$customers->isEmpty())

        <div class="row">
            <div class="col-6">
                <span><b>Record Count: </b></span><span class="badge badge-warning font-weight-normal">{{ $customers->total() }}</span>
            </div>
            <div class="col-6">
                @include('pagination', ['customers' => $customers])
            </div>
        </div>
            <div class="table-responsive mt-1">
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
                                        <img src="{{ asset('storage/uploads') . '/' . $customer->customer_image }}"
                                            alt="" class="rounded-circle border border-primary" width="50"
                                            height="50">
                                    @else
                                        <img src="{{ asset('storage/images') }}/men-dummy.png" alt=""
                                            class="rounded-circle border border-primary" width="50" height="50">
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
                                        <span class="badge badge-success user-status-class"
                                            data-cid="{{ $customer->customer_id }}">Active</span>
                                    @else
                                        <span class="badge badge-danger user-status-class"
                                            data-cid="{{ $customer->customer_id }}">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('customer.delete', ['id' => $customer->customer_id]) }}"><button
                                            class="btn btn-danger">Trash</button></a>
                                    <a href="{{ route('customer.edit', ['id' => $customer->customer_id]) }}"><button
                                            class="btn btn-primary">Edit</button></a>
                                </td>

                            </tr>
                            @php
                                $num++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        @elseif($customers->isEmpty())
            <div class="alert alert-info mt-2" role="alert">
                {{-- Customer Table Is Empty. --}}
                No Result Found.
            </div>
        @endif

    </div>
    <script>
        // global app configuration object
        var ajaxData = {
            routes: {
                status: "{{ route('customer.status') }}"
            }
        };
    </script>
@endsection

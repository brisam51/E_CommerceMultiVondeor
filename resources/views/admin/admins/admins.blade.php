@extends('admin.layout.layout') @section('content')
<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{$title}}</h4>
            <p class="card-description">Add class <code>.table-striped</code></p>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>
                               Admin_ID
                            </th>
                            <th>
                              Name
                            </th>
                            <th>
                               Type
                            </th>
                            <th>
                                vendor_Id
                            </th>
                            <th>
                               Mobile
                            </th>
                            <th>
                               Email
                             </th>
                             <th>
                                Image
                              </th>
                              <th>
                                status
                              </th>
                              <th>
                                Action
                              </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td class="py-1">
                                {{$admin['id']}}
                            </td>
                            <td>
                                {{$admin['name']}}
                            </td>
                            <td>
                                {{$admin['type']}}
                            </td>
                            <td>
                                {{$admin['vondar_id']}}
                            </td>
                            <td>
                                {{$admin['mobile']}}
                            </td>
                            <td>
                                {{$admin['email']}}
                            </td>
                            <td>
                               
                               
                               <img src="{{asset('admin/images/photos/'.$admin['image'])}}" alt="">
                            </td>
                            <td>
                               @if($admin['status']==1)
                               Active
                               @else
                               Inactive
                               @endif
                            
                            </td>
                        </tr>
                       
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

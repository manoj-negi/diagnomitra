@extends('layouts.adminCommon')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 text-right">
         <?php  $url = Request::segment(1); ?>
         <a class="btn btn-primary btn-sm my-3" href='{{url("profile/create?url=$url")}}'>Create</a>
         @if ($message = Session::get('msg'))
         <div class="alert alert-danger alert-dismissible text-left mt-2 alertmsg mb-3">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
         </div>
         @endif
      </div>
      <div class="col-lg-12">
         <div class="demo-inline-spacing">
            <div class="card">
               
               <div class=" px-0 mt-0">
                  
                  <div class="tab-pane fade active show" id="document">
                     
                     <div class="table-responsive text-nowrap">
                     <form action="">
               <div class="row">
                  <div class="col-md-1">
                     <div class="paging-section justify-content-start">
                        <select style="width:75px;" class="form-select form-select" name="pagination" id="itemsPerPage" onchange="this.form.submit()" fdprocessedid="hk0hs">
                           <option value="10" {{ app('request')->input('pagination') == '10' ? 'selected' : '' }}>10</option>
                           <option value="30" {{ app('request')->input('pagination') == '30' ? 'selected' : '' }}>30</option>
                           <option value="50" {{ app('request')->input('pagination') == '50' ? 'selected' : '' }}>50</option>
                           <option value="70" {{ app('request')->input('pagination') == '70' ? 'selected' : '' }}>70</option>
                           <option value="100" {{ app('request')->input('pagination') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-11">
                     <div class="paging-section justify-content-end row">
                        <div class="col-md-2 mt-3">
                        </div>
                        <div class="col-md-2 mt-3">
                           @if(Auth::user()->roles->contains(1) && Request::segment(1) != 'diagno-profiles')
                           <select name="lab" id="" class="form-control mr-1" style="color:#697a8d!important;" fdprocessedid="hkqlg7">
                              <option value="">Select Lab</option>
                              <option value="1" {{ app('request')->input('lab') == '1' ? 'selected' : '' }}>Diagno Mitra</option>
                              @foreach($labs ?? [] as $item)
                              <option value="{{$item->id ?? ''}}" {{ app('request')->input('lab') == $item->id ? 'selected' : '' }}>{{$item->name ?? ''}}</option>
                              @endforeach
                           </select>
                           @endif
                        </div>
                        <div class="col-md-3 mt-3 d-flex">
                           <input type="" id="search" name="search" placeholder="Search" class="form-control" value="{{ app('request')->input('search') }}" placehoder="Search" fdprocessedid="tdutng">
                           <button type="submit" class="form-control src-btn" fdprocessedid="l5a1oq"><i class="fa fa-search" aria-hidden="true"></i></button>
                           <a class="form-control  src-btn" href="{{url('lab-test')}}"><i class="fa fa-rotate-left"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               </form>
                     <form action="{{url('package-amount-update')}}">
                     @if(Auth::user()->roles->contains(4))
                              <button class="btn btn-primary m-2" style="float:right;" type="submit">Save</button>
                              @endif
                              <table class="table table table-bordered m-2">
                                 <thead>
                                    <tr>
                                       <th style="width: 10px!important;">id</th>
                                       @if(Auth::user()->roles->contains(4))
                                       <th>available</th>
                                       @endif
                                       <th>Profile Name</th>
                                       @if(Auth::user()->roles->contains(4))
                                       <th>Main Profile Name</th>
                                       @endif
                                       <th>Total Tests</th>
                                       @if(Auth::user()->roles->contains(1))  <th>Lab</th> @endif
                                       <th>Amount</th>
                                       <th style="width: 160px!important;">Action</th>
                                    </tr>
                                    @forelse($data as $key => $result)
                                    @php 
                                       $value =  \App\Models\LabSelectedPackages::where("lab_id",Auth::user()->id)->where("package_id", $result->id)->first();
                                    @endphp
                                   
                                    <tr>
                                      
                                       <td>{{$key+1}}</td>
                                       @if(Auth::user()->roles->contains(4))
                                       <td>
                                          <div class="form-check form-check-inline mt-3">
                                          <input class="form-check-input checkbox" data="{{$result->id}}" type="checkbox" id="inlineCheckbox1" value="1" {{ !empty($value) && $value->is_selected=='1' ? 'checked' : '' }}>
                                          <input type="hidden" name="checkbox[]" class="form-control" id="checked_{{$result->id}}" value="{{ !empty($value) && $value->is_selected=='1' ? '1' : '0' }}">  
                                       </div>
                                       </td>
                                       @endif
                                       <td>{{ isset($result->package_name) ? $result->package_name : 'Package not selected' }}</td>

                                       @if(Auth::user()->roles->contains(4))
                                       <td>
                                       @php
                                          $subPackages = \App\Models\Package::where('type', 'profile')
                                          ->where('id',$result->parent_id)->first();
                                       @endphp
                                             {{ $subPackages->package_name ?? '--' }}
                                       </td>
                                       @endif
                                       <td>{{ isset($result->getChilds) ? count($result->getChilds) : '' }}</td>
                                       @if(Auth::user()->roles->contains(1))
                                       <td>
                                          @php 
                                          if(Auth::user()->roles->contains(1)){
                                             if($result->lab_id != Auth::user()->id){
                                                   echo  isset($result->labDetails) ? $result->labDetails->name : '-'; 
                                             }else{
                                                   echo 'Diagno Mitra';
                                             }

                                          }elseif(Auth::user()->roles->contains(4)){
                                             if(Auth::user()->id == $result->lab_id){
                                                   echo Auth::user()->name ?? '-';
                                             }else{
                                                echo 'Diagno Mitra';
                                             }

                                          }
                                          @endphp
                                       </td>
                                       @endif
                                       <td>
                                       @if(Auth::user()->roles->contains(4))
                                       <input type="text" name="amount[]" class="form-control" value="{{$value->amount ?? $result->amount }}">
                                       <input type="hidden" name="packagesID[]" class="form-control" value="{{$result->id }}">
                                       @else
                                          {{number_format($result->amount,2)}}
                                       @endif

                                       </td>
                                       <td>
                                       <a class="btn btn-primary btn-sm" href="{{route('profile.show', $result->id)}}">
                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                       </a>
                                          @if(Auth::user()->roles->contains(1) || Auth::user()->id == $result->lab_id)
                                       <a class="btn btn-primary btn-sm" href='{{route('profile.edit', $result->id)."?url=$url"}}'>
                                             <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                          </a>
                                         
                                             <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{url('profile-destroy',$result->id)}}" 
                                             <button class="btn btn-danger btn-sm" type="submit">
                                             <i class="fa fa-trash"  aria-hidden="true" style="color:#fff"></i>
                                             </button>
                                          </a>
                                 
                                          @endif
                                       </td>
                                    </tr>
                                    
                                    @empty
                                    <tr>
                                       <td colspan="6" class="text-center">No Data Found</td>
                                    </tr>
                                    @endforelse
                                    
                              </table>
                              <div id="pagination">{{{ $data->links() }}}</div>
                           </form>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js')
<script>
   $(document).ready(function() {
        $(document).on('change', '.checkbox', function() {
         var value = $(this).attr('data');
         if ($(this).is(':checked')) {
            $("#checked_"+value).val(1);
         } else {
            $("#checked_"+value).val(0);
         }
   });
   $(document).on('change', ".onChangeStatusSelect", function () {
       $(this).closest('form').submit();
   });
   });
   $(document).ready(function() {
   $('#pagination').on('change', function() {
   
       var form = $(this).closest('form');
       $form.find('input[type=submit]').click();
       console.log($form);
   
   });
   setTimeout(function(){
      $("div.alert").remove();
   }, 3000 ); // 3 secs
   });
   
   // var table = $('.yajra-datatable').DataTable({
   //      processing: true,
   //      serverSide: true,
   //      dom: 'Bfrtip',
   //      buttons: [
   //     {
   //         extend: 'csvHtml5',
   //         exportOptions: {
   //             columns: [0, 1, 2, 3,]
   //         }
   //     }
   // ],
        
   //      ajax: "",
   //      columns: [
   //         {data: 'id', name: 'id',searchable:true},
   //         @if(Auth::user()->roles->contains(4))
   //          {data: 'available', name: 'available',searchable:true},
   //         @endif
   //          {data: 'package_name', name: 'package_name',searchable:true},
           
   //         { data: 'Profile', name: 'Profile', searchable: true },
   
   //         { data: 'amount', name: 'amount', searchable: true },
   
   //          {data: 'action', name: 'action'},
            
   //      ],columnDefs: [{
   //     targets: 0, // The column index for S.No
   //     render: function (data, type, row, meta) {
   //         return meta.row + 1; // Start numbering from 1
   //     }
   // }]
     
   //  });
</script>
<style>
   .form-select:focus {
   border-color: #007ac2 !important;
   }
   td {
   white-space: normal!important;
   }
   .switch {
   position: relative;
   display: inline-block;
   width: 60px;
   height: 29px;
   }
   .switch input { 
   opacity: 0;
   width: 0;
   height: 0;
   }
   .slider {
   position: absolute;
   cursor: pointer;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-color: #ccc;
   -webkit-transition: .4s;
   transition: .4s;
   }
   .slider:before {
   position: absolute;
   content: "";
   height: 22px;
   width: 22px;
   left: 4px;
   bottom: 4px;
   background-color: white;
   -webkit-transition: .4s;
   transition: .4s;
   }
   input:checked + .slider {
   background-color: #2196F3;
   }
   input:focus + .slider {
   box-shadow: 0 0 1px #2196F3;
   }
   input:checked + .slider:before {
   -webkit-transform: translateX(26px);
   -ms-transform: translateX(26px);
   transform: translateX(26px);
   }
   /* Rounded sliders */
   .slider.round {
   border-radius: 34px;
   }
   .slider.round:before {
   border-radius: 50%;
   }
   
</style>
@endsection
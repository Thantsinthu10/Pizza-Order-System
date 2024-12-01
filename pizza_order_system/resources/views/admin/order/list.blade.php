@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                   <form action="{{ route('admin#changeStatus') }}" method="get" class="col-5">

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa-solid fa-database mr-2"></i>{{ count($order) }}
                            </span>
                        </div>
                        <select name="orderStatus" class="custom-select" id="inputGroupSelect02" >
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus' )== '0') selected @endif>Pending</option>
                            <option value="1" @if (request('orderStatus' )== '1') selected @endif>Success</option>
                            <option value="2" @if (request('orderStatus' )== '2') selected  @endif>Reject</option>
                           </select>
                           <div class="input-group-append">
                            <button type="submit" class="btn btn-sm ms-3 bg-dark text-white input-group-text"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                           </div>
                    </div>


                   </form>

                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                                    @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td class="">{{ $o->user_id }}</td>
                                        <td class="">{{ $o->user_name }}</td>
                                        <td class="">{{ $o->created_at->format('F j Y') }}</td>
                                        <td class="">
                                            <a href="{{ route('admin#listInfo',$o->order_code) }}">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td class="">{{ $o->total_price }}</td>
                                        <td class="">
                                           <select name="status" class="form-control statusChange" id="">
                                            <option value="0" @if ($o->status == 0) selected  @endif>Pending</option>
                                            <option value="1" @if ($o->status == 1) selected  @endif>Success</option>
                                            <option value="2" @if ($o->status == 2) selected  @endif>Reject</option>
                                           </select>
                                        </td>
                                    </tr>
                                    @endforeach

                            </tbody>
                        </table>
                        {{-- <div class="mt-3">
                            {{ $order->links() }}
                        </div> --}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')

<script>
$(document).ready(function(){
//     $('#orderStatus').change(function(){
//             $status = $('#orderStatus').val();

//             $.ajax({
//         type : 'get' ,
//         url : 'http://localhost:8000/order/ajax/status',
//         data : { 'status' : $status,},
//         dataType : 'json',
//         success : function(response){


//         $list = ``;
//         for($i=0;$i<response.length;$i++){


//             $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
//             $dbDate = new Date(response[$i].created_at);
//             $finalDate = $months[$dbDate.getMonth()] +"-"+ $dbDate.getDate() +"-"+ $dbDate.getFullYear();

//             if(response[$i].status == 0){
//                 $statusMessage = `
//                 <select name="status" class="form-control" statusChange id="">
//                                             <option value="0" selected >Pending</option>
//                                             <option value="1" >Success</option>
//                                             <option value="2" >Reject</option>
//                                            </select>
//                 `;
//             }else if(response[$i].status == 1){
//                 $statusMessage =`
//                 <select name="status" class="form-control" statusChange id="">
//                                             <option value="0"  >Pending</option>
//                                             <option value="1" selected>Success</option>
//                                             <option value="2" >Reject</option>
//                                            </select>
//                 `;
//             }else if(response[$i].status == 2){
//                 $statusMessage =`
//                 <select name="status" class="form-control" statusChange id="">
//                                             <option value="0"  >Pending</option>
//                                             <option value="1" >Success</option>
//                                             <option value="2" selected>Reject</option>
//                                            </select>
//                 `;
//             }

//             $list += `
//             <tr class="tr-shadow">
//                                         <td class="">${response[$i].user_id}</td>
//                                         <td class="">${response[$i].user_name}</td>
//                                         <td class="">${$finalDate}</td>
//                                         <td class="">${response[$i].order_code}</td>
//                                         <td class="">${response[$i].total_price}</td>
//                                         <td class="">${$statusMessage}</td>
//                                     </tr>
//         `;
//                  }
//            $('#dataList').html($list);
//              }
//         })
// })
        //change status
        $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents('tr');
        $orderId = $parentNode.find('.orderId').val();

        $data = {
            'status' : $currentStatus,
            'orderId' : $orderId
        };
        console.log($data);

        $.ajax({
        type : 'get' ,
        url : 'http://localhost:8000/order/ajax/change/status',
        data : $data,
        dataType : 'json',
    })


        })
    })
</script>

@endsection

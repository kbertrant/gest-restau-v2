@extends('main')
@section('title', ' - Delivery')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ __('mypage.mydelivery') }}
                </button>
            </div>
            <br>
            <h2>{{ __('mypage.myListdelivery') }}</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="deliverytable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NUMBER</th>
                        <th>FEES</th>
                        <th>STATUS</th>
                        <th>ADDRESS</th>
                        <th>AMOUNT</th>
                        <th>CLIENT</th>
                        <th>PHONE</th>
                        <th>USER</th>
                        <th>Action</th>
                    </tr>
                    </thead>
            </table>
            </div>
        </div>  
    </div>
</div>
<!-- begin modal for create -->
<!-- Button trigger modal -->  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('mypage.myUpdateDelivery') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('delivery.pay')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <select name="dev_id" id="dev_id" class="form-control shadow">
                        <option value="">{{ __('mypage.myDeliveryAttente') }}</option>
                        @foreach ($list_devs as $list_dev)
                            <option value="{{ $list_dev->id }}">{{ $list_dev->dev_num }} - {{ $list_dev->dev_ttval }} F CFA</option>
                        @endforeach 
                    </select>
                    <br/>
                    <select name="dev_stat" id="dev_stat" class="form-control shadow">
                        <option value="Processing">Processing</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <br/>
                   
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ __('mypage.myDeliverProcess') }}</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
<script type="text/javascript">
    window.onload = function(){
        $(document).ready(function(){
                $('#deliverytable').DataTable({
                serverSide: true,
                ajax: '{{ route('delivery.list') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'dev_num', name: 'dev_num' },
                    { data: 'dev_fees', name: 'dev_fees' },
                    { data: 'dev_stat', name: 'dev_stat' },
                    { data: 'dev_address', name: 'dev_address' },
                    { data: 'dev_ttval', name: 'dev_ttval' },
                    { data: 'cl_name', name: 'cl_name' },
                    { data: 'cl_phone', name: 'cl_phone' },
                    { data: 'usr_name', name: 'usr_name' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
            });
        });
    
    }
</script>
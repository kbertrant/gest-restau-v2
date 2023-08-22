@extends('main')
@section('title', ' - Paiements')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            @if (session('success'))
                <div class="alert alert-danger" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ __('mypage.myNewPayment') }}
                </button>
            </div>
            <br>
            <h2>{{ __('mypage.myListpayment') }}</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="paytable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NUMBER</th>
                        <th>MODE</th>
                        <th>AMOUNT</th>
                        <th>STATUT</th>
                        <th>CLIENT</th>
                        <th>PHONE</th>
                        <th>CAISSE</th>
                        <th>NUM. CMD</th>
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
                <h5 class="modal-title" id="exampleModalLabel">{{ __('mypage.myEffectuerPayment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('payments.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <select name="cmd_id" id="cmd_id" class="form-control shadow">
                        <option value="">{{ __('mypage.myCommAttente') }}</option>
                        @foreach ($list_coms as $list_com)
                            <option value="{{ $list_com->id }}">{{ $list_com->numero }} - {{ $list_com->ttval }} F CFA</option>
                        @endforeach 
                    </select>
                    <br/>
                    <select name="pay_mode" id="pay_mode" class="form-control shadow">
                        <option value="">{{ __('mypage.myChoiceModePay') }}</option>
                        <option value="En espèces">En espèces / Cash</option>
                        <option value="Orange Money">Orange Money</option>
                        <option value="MTN Mobile Money">MTN Mobile Money</option>
                        <option value="Carte bancaire">visa Card / Carte bancaire</option>
                    </select>
                    <br/>
                    <input type="text" name="pay_amount" id="pay_amount" placeholder="{{ __('mypage.myAmountpay') }}"
                       class="form-control shadow"  required />
                    <br/>
                    
                    <br/>
                    
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ __('mypage.myPayer') }}</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
<script type="text/javascript">
    window.onload = function(){
        $(document).ready(function(){
                $('#paytable').DataTable({
                serverSide: true,
                ajax: '{{ route('payments.list') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'pay_num', name: 'pay_num' },
                    { data: 'pay_mode', name: 'pay_mode' },
                    { data: 'pay_amount', name: 'pay_amount' },
                    { data: 'pay_stat', name: 'pay_stat' },
                    { data: 'cl_name', name: 'cl_name' },
                    { data: 'cl_phone', name: 'cl_phone' },
                    { data: 'usr_name', name: 'usr_name' },
                    { data: 'numero', name: 'numero' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
            });
        });
    
    }
</script>
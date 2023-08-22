@extends('main')

@section('title', ' - Etats de service')


@section('main-content')
<div class="container">
  
    <div class="row justify-content-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">States</h1>
        </div>
        <div class="col-lg-10 col-md-10">            
                <div class="card shadow  h-100 py-2">
                  <div class="card-body row">
                    <div class="col-lg-3">
                      <a type="button" class="btn btn-primary" href="/generate/daily/">
                        Imprimer
                      </a>
                    </div>
                    <div class="col-lg-3">
                      <select name="cmd_stat" id="cmd_stat" class="form-control shadow">
                        <option value="">Choose order status</option>
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Canceled">Canceled</option>
                      </select>
                    <br/>
                    </div>
                    <div class="col-lg-3">
                      <input type="date" name="created_at" id="created_at" 
                                class="form-control shadow"  required />
                    <br/>
                    </div>
                    <div class="col-lg-3">
                      <button class="btn btn-warning" type="submit" id="comment">Research</button>
                    </div>
                  </div>
                    <div class="card-body">
                    
                      <h1 class="h3 text-gray-800 align-items-center">Daily orders</h1>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="etatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NUMBER</th>
                                    <th>STATUS</th>
                                    <th>CLIENT</th>
                                    <th>AMOUNT</th>
                                    <th>SERVER</th>
                                    <th>DELIVERY</th>
                                    <th>DATE</th>
                                    <th>Action</th>
                                  </tr>
                            </thead>
                        </table>
                      </div>
                      <br>
                  </div>
                  <div id="piechart" class="container" style="height: 400px;"></div>
                </div>
              </div>
        </div>
    </div>
</div>

    
@endsection
<script type="text/javascript">
  window.onload = function(){
      $(document).ready(function(){
              $('#etatable').DataTable({
              serverSide: true,
              ajax: '{{ route('research') }}',
              columns: [
                  { data: 'id', name: 'id','visible':true },
                  { data: 'numero', name: 'numero' },
                  { data: 'cmd_stat', name: 'cmd_stat' },
                  { data: 'cl_name', name: 'cl_name' },
                  { data: 'ttval', name: 'ttval' },
                  { data: 'name', name: 'name' },
                  { data: 'cmd_delivery', name: 'cmd_delivery' },
                  { data: 'created_at', name: 'created_at',type: 'datetime',
                    def: () => new Date(),
                    format: 'dddd D MMMM YYYY',
                    fieldInfo: 'Verbose date format',keyInput: false},
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });

      });
  
    $(document).ready(function(){
      $('#comment').on('submit', function(e) {
        console.log('test');
            e.preventDefault();
            var cmd_stat = $('#cmd_stat').val();
            var created_at = $('#created_at').val();
            $.ajax({
              type: "POST",
              url: host+'/send/research',
              data: { cmd_stat:cmd_stat, created_at:created_at }, 
              success: function( msg ) {
                  alert( msg );
              }
            });

      });
    });
  }
</script>
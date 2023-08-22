<div class="container">
    <!-- Title -->
    <div class="d-flex justify-content-between align-items-center py-3">
      <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{$print_coms->numero}}</h2>
    </div>
  
    <!-- Main content -->
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <!-- Details -->
        <div class="card mb-1">
          <div class="card-body">
            <div class="mb-3 d-flex justify-content-between">
              <div>
                <span class="me-3">{{$print_coms->created_at}} </span>
                <span class="me-3"> {{$print_coms->cmd_stat}}</span>
                @if ($print_coms->cmd_delivery=='Y')
                  <span class="badge rounded-pill bg-info">TO DELIVERY</span>
                @else
                @endif
              </div>
            </div>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th> DESIGNATIONS</th>
                  <th>QTY</th>
                  <th>P.U.</th>
                  <th>TOTAL</th>
                </tr>
            </thead> 
              <tbody>
                @foreach($print_details as $print_detail=>$data)
                <tr>
                  <td>
                    <div class="d-flex mb-2">
                      <div class="flex-lg-grow-1 ms-3">
                        <h6 class="small mb-0">{{ $data->prod_name }}</h6>
                        
                      </div>
                    </div>
                  </td>
                  <td>x{{ $data->quantite }}</td>
                  <td class="text-end">{{ $data->prix_unit }} XAF</td>
                  <td class="text-end">{{ $data->quantite*$data->prix_unit }} XAF</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">SUB TOTAL</td>
                  <td colspan="1"></td>
                  <td class="text-end">{{$print_coms->ttval}} XAF</td>
                </tr>
                @if ($print_coms->cmd_delivery=='Y')
                  <tr>
                    <td colspan="2">Delivery fees</td>
                    <td colspan="1"></td>
                    <td class="text-end">{{$print_coms->dev_fees}}</td>
                  </tr>
                  <tr>
                    <td colspan="2">Delivery packaging</td>
                    <td colspan="1"></td>
                    <td class="text-end">{{$print_coms->packaging}}</td>
                  </tr>
                  <tr class="fw-bold">
                    <td colspan="2">TOTAL</td>
                    <td colspan="1"></td>
                    <td class="text-end">{{$print_coms->dev_ttval}} XAF</td>
                  </tr>
                @else
                  <tr class="fw-bold">
                    <td colspan="2">TOTAL</td>
                    <td colspan="1"></td>
                    <td class="text-end">{{$print_coms->ttval}} XAF</td>
                  </tr>
                @endif
                
                
              </tfoot>
            </table>
          </div>
        </div>
        <!-- Payment -->
        
      </div>
        @if ($print_coms->cmd_delivery=='Y')
            <div class="col-lg-12 col-xs-12">
        
                <div class="card mb-4">
                <!-- Shipping information -->
                    <div class="card-body">
                        
                        <strong>DELIVERY</strong>
                        <hr>
                        <h3 class="h6">Address</h3>
                        <address>
                        <abbr title="Phone">Client : </abbr><strong>{{$print_coms->cl_name}}</strong><br>
                        
                            <abbr title="Phone">Address delivery: </abbr>{{$print_coms->dev_address}}<br>
                        
                        
                        <abbr title="Phone">Phone : </abbr> {{$print_coms->cl_phone}}
                        </address>
                    </div>
                </div>
            </div>
            @endif
    </div>
  </div>
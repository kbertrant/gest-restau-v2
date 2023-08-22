<div class="container">
    <!-- Title -->
    <div class="d-flex justify-content-between align-items-center py-3">
      <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Daily orders {{$date_today}}</h2>
    </div>
  
    <!-- Main content -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
        <!-- Details -->
            <div class="card mb-1">
                <div class="card-body">
                    
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th><h6 class="small mb-0">NUMBER</h6></th>
                            <th><h6 class="small mb-0">STATUS</h6></th>
                            <th><h6 class="small mb-0">AMOUNT</h6></th>
                            <th><h6 class="small mb-0">SERVER</h6></th>
                            <th><h6 class="small mb-0">DELIVERY</h6></th>
                            <th><h6 class="small mb-0">CLIENT</h6></th>
                            <th><h6 class="small mb-0">DATE</h6></th>
                            </tr>
                            </thead> 
                            <tbody>
                            @foreach($cmds as $cmd=>$data)
                            <tr>
                            <td>
                                <div class="d-flex mb-2">
                                <div class="flex-lg-grow-1 ms-3">
                                    <h6 class="small mb-0">{{ $data->numero }}</h6>
                                </div>
                                </div>
                            </td>
                            <td><h6 class="small mb-0">{{ $data->cmd_stat }}</h6></td>
                            <td class="text-end"><h6 class="small mb-0">{{ $data->ttval }}</h6> </td>
                            <td class="text-end"><h6 class="small mb-0">{{ $data->usr_name }}</h6> </td>
                            <td class="text-end"><h6 class="small mb-0">{{ $data->cmd_delivery }}</h6> </td>
                            <td class="text-end"><h6 class="small mb-0">{{ $data->cl_name }}</h6> </td>
                            <td class="text-end"><h6 class="small mb-0">{{ $data->cmd_date }}</h6> </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Number :</td>
                                <td>{{$count}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total :</td>
                                <td>{{$som}} XAF</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- Payment -->
        </div>
    </div>
</div>
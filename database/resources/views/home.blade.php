@extends('main')

@section('title', ' - Accueil')


@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('mypage.myDashboard') }}</h1>
        </div>
        <div class="col-lg-10 col-md-10">
            <div class="card-group">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('mypage.homeCommandes') }}</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $nbre_commande[0]->nbre_com ?? '' }}</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                          <div class="card-body">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('mypage.homeTotal') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $som_commande[0]->sum_com ?? ''}}</div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                          <div class="card-body">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('mypage.homeStock') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_stock[0]->nbre_stock ?? ''}}</div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                              <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> {{ __('mypage.homeNombre') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                  </div>
                                  <div class="col-auto">
                                    <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
            </div>
            
        </div>
    </div>
   
    <h1 class="h3 text-gray-800 align-items-center">{{ __('mypage.myCommandes') }}</h1>
    <div class="table-responsive">
      <table class="table table-bordered" id="hometable">
        <thead>
          <tr>
            <th>ID</th>
            <th>NUMERO</th>
            <th>CLIENT</th>
            <th>CLIENT PHONE</th>
            <th>MONTANT</th>
            <th>SERVEUR</th>
            <th>TABLE</th>
          </tr>
      </thead> 
    </table>
    <br>
  </div>
</div>
@endsection
<script type="text/javascript">
  window.onload = function(){
       $(document).ready(function(){
              $('#hometable').DataTable({
              serverSide: true,
              ajax: '{{ route('home.list') }}',
              columns: [
                { data: 'cmd_id', name: 'cmd_id' },
                  { data: 'numero', name: 'numero' },
                  { data: 'cl_name', name: 'cl_name' },
                  { data: 'cl_phone', name: 'cl_phone' },
                  { data: 'ttval', name: 'ttval' },
                  { data: 'usr_name', name: 'usr_name' },
                  { data: 'cmd_delivery', name: 'cmd_delivery' },
                  
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>
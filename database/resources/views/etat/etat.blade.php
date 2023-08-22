@extends('main')

@section('title', ' - Etats de service')


@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Etats de service</h1>
        </div>
        <div class="col-lg-10 col-md-10">            
                <div class="card shadow  h-100 py-2">
        
                    <div class="card-body">
                    
                    <h1 class="h3 text-gray-800 align-items-center">Perfomance des serveur(es)</h1>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>NOMS</th>
                              <th>NOMBRE</th>
                              <th>TOTAL</th>
                            </tr>
                          </thead>
                          <tbody>
                            @for($i=0;$i<$n;$i++)
                            <tr> 
                                <td>{{ $list_serveurs[$i]->name }}</td>
                                <td>{{ $nbres_commandes[$i] }}</td>
                                <td><b>
                                    @if($soms_commandes[$i]==null)
                                    {{ 0 }} FCFA
                                    @else
                                    {{ $soms_commandes[$i] }} FCFA
                                    @endif
                                </b></td>
                            </tr>    
                            @endfor
                        </tbody>
                    </table>
                    <br>
                  </div>
                  <div id="piechart" class="container" style="height: 400px;"></div>
                </div>
              </div>
        </div>
    </div>
</div>

    
@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      17],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Watch Movies', 5],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'Graphe des serveurs(es)'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
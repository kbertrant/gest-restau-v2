<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <div class=""><img class="rounded-circle" src="{{ asset('img/logo_home.jpg') }}"/> Marmite dorée</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('sidebar.myAccueil') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    @if($privation->commande==1)
      <li class="nav-item">
          <a class="nav-link" href="{{ route('commandes.main') }}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>{{ __('sidebar.myCommandes') }}</span></a>
        </li>
        
    @else
    @endif
    @if($privation->paiements==1)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('payments.main') }}">
        <i class="fas fa-fw fa-anchor"></i>
        <span>{{ __('sidebar.myPaiements') }}</span></a>
    </li>
    @else
    @endif
    @if($privation->delivery==1)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('delivery.main') }}">
        <i class="fas fa-fw fa-cart-arrow-down"></i>
        <span>{{ __('sidebar.myDelivery') }}</span></a>
    </li>
    @else
    @endif
    
    <!-- Nav Item - Charts -->
    @if($privation->produit==1)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('produits.main') }}">
          <i class="fas fa-fw fa-th-list"></i>
          <span>{{ __('sidebar.myProduits') }}</span></a>
      </li>
       @else
      
    @endif
      <!-- Nav Item - Charts -->
      @if($privation->stock==1) 
    <li class="nav-item">
        <a class="nav-link" href="{{ route('increment') }}">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>{{ __('sidebar.myStock') }}</span></a>
      </li>
      @else
      
    @endif
    @if($privation->groupe==1)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('groupes.main') }}">
          <i class="fas fa-fw fa-user-plus"></i>
          <span>{{ __('sidebar.myGU') }}</span></a>
      </li>
    @else
      
    @endif
    @if($privation->user==1) 
      <li class="nav-item">
        <a class="nav-link" href="{{ route('personnels.main') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>{{ __('sidebar.myUser') }}</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.main') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>{{ __('sidebar.myCategory') }}</span></a>
      </li>
      @else
      
    @endif 
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item - Charts -->
 @if($privation->etat==1)
<li class="nav-item">
    <a class="nav-link" href="{{ route('etat') }}">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>{{ __('sidebar.myEtat') }}</span></a>
  </li>
  @else
  
@endif
    <!-- Nav Item - Tables -->
    @if($privation->parametres==1) 
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-key"></i>
        <span>{{ __('sidebar.myParam') }}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tables.main') }}">
        <i class="fas fa-fw fa-key"></i>
        <span>{{ __('sidebar.myTable') }}</span></a>
    </li>
     @else
  
@endif 

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
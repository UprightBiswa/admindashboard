  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/dashboard') }}">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
              </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#customer" aria-expanded="false" aria-controls="customer">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">customer</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="customer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/customers/create') }}">Add Customer</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/customers') }}">View Customer</a> </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#service" aria-expanded="false" aria-controls="service">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">service</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="service">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/services/create') }}">Add Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/services') }}">View Service</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#invoice" aria-expanded="false" aria-controls="invoice">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Invoice</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="invoice">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/invoices/create') }}">Add Invoice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/invoices') }}">View Invoice</a></li>
                </ul>
            </div>
        </li>

          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#quotation" aria-expanded="false"
                  aria-controls="quotation">
                  <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                  <span class="menu-title">quotation</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="quotation">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/quotations/create') }}"> Add  Quotation </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/quotations') }}"> View Quotation</a></li>
                  </ul>
              </div>
          </li>
      </ul>
  </nav>

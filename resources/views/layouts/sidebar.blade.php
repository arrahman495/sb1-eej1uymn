<!-- Dashboard -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

@if(Auth::user()->isSuperAdmin())
    <!-- Super Admin Menu -->
    <li class="nav-header">SUPER ADMIN</li>
    <li class="nav-item">
        <a href="{{ route('super-admin.isp-owners.index') }}" class="nav-link {{ request()->routeIs('super-admin.isp-owners.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-building"></i>
            <p>ISP Owners</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('super-admin.modules.index') }}" class="nav-link {{ request()->routeIs('super-admin.modules.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-puzzle-piece"></i>
            <p>Modules</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Advanced Reports</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>System Settings</p>
        </a>
    </li>

@elseif(Auth::user()->isIspOwner())
    <!-- ISP Owner Menu -->
    <li class="nav-header">ISP MANAGEMENT</li>
    <li class="nav-item">
        <a href="{{ route('isp-owner.domains.index') }}" class="nav-link {{ request()->routeIs('isp-owner.domains.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-globe"></i>
            <p>Domains</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('isp-owner.resellers.index') }}" class="nav-link {{ request()->routeIs('isp-owner.resellers.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Resellers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('isp-owner.mikrotiks.index') }}" class="nav-link {{ request()->routeIs('isp-owner.mikrotiks.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-router"></i>
            <p>MikroTik Routers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('isp-owner.pppoe-users.index') }}" class="nav-link {{ request()->routeIs('isp-owner.pppoe-users.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>PPPoE Users</p>
        </a>
    </li>
    <li class="nav-item has-treeview {{ request()->routeIs('isp-owner.pop.*') || request()->routeIs('isp-owner.radius.*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-network-wired"></i>
            <p>
                Network Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>POP Zones</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>RADIUS Server</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
                Billing
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoices</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payment History</p>
                </a>
            </li>
        </ul>
    </li>

@elseif(Auth::user()->isReseller())
    <!-- Reseller Menu -->
    <li class="nav-header">RESELLER PANEL</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>My Customers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Sub Resellers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-percentage"></i>
            <p>Commission</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reports</p>
        </a>
    </li>

@elseif(Auth::user()->isSubReseller())
    <!-- Sub Reseller Menu -->
    <li class="nav-header">SUB RESELLER PANEL</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>My Customers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-percentage"></i>
            <p>Commission</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reports</p>
        </a>
    </li>

@elseif(Auth::user()->isStaff())
    <!-- Staff Menu -->
    <li class="nav-header">STAFF PANEL</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>Assigned Tasks</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Support Tickets</p>
        </a>
    </li>
@endif

<!-- Common Menu Items -->
<li class="nav-header">ACCOUNT</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>Settings</p>
    </a>
</li>
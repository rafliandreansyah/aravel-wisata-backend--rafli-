<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Ticket POS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Master</li>
            <li class="nav-item {{ $type_menu === 'users' ? 'active' : '' }}">
                <a href="/users" class="nav-link"><i class="fas fa-users"></i><span>Users</span></a>

            </li>
            <li class="nav-item {{ $type_menu === 'categories' ? 'active' : '' }}">
                <a href="/categories" class="nav-link"><i class="fas fa-layer-group"></i><span>Categories</span></a>

            </li>
            <li class="nav-item {{ $type_menu === 'products' ? 'active' : '' }}">
                <a href="/products" class="nav-link"><i class="fas fa-ticket-simple"></i><span>Tickets</span></a>

            </li>
            <li class="menu-header">Transaction</li>
            <li class="nav-item {{ $type_menu === 'orders' ? 'active' : '' }}">
                <a href="/orders" class="nav-link"><i class="fas fa-layer-group"></i><span>Orders</span></a>
            </li>
        </ul>
    </aside>
</div>

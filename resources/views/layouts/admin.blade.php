<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

body {
    background:#f5f7fb;
}

/* SIDEBAR */
.sidebar {
    width:250px;
    height:100vh;
    position:fixed;
    background:#111827;
    padding:20px;
}

.sidebar h4 {
    color:white;
    margin-bottom:20px;
}

.sidebar a {
    color:#cbd5e1;
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    margin-bottom:8px;
    transition:0.2s;
}

.sidebar a:hover {
    background:#1f2937;
    color:white;
}

.sidebar a.active {
    background:#2563eb;
    color:white;
}

/* CONTENT */
.content {
    margin-left:250px;
    padding:20px;
}

/* TOPBAR */
.topbar {
    background:white;
    border-radius:10px;
    margin-bottom:20px;
}

/* MAIN CONTENT WRAPPER */
.main-content {
    margin-top:10px;
}

/* SEARCH */
.search-input {
    width:200px;
    border-radius:20px;
}

/* CARDS */
.card {
    border:none;
    border-radius:15px;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4>
        👑 Admin
    </h4>

    <!-- HOME -->
    <a href="/"
       class="{{ request()->is('/') ? 'active' : '' }}">

        <i class="bi bi-house"></i>

        Home

    </a>

    <!-- DASHBOARD -->
    <a href="/admin"
       class="{{ request()->is('admin') ? 'active' : '' }}">

        <i class="bi bi-speedometer2"></i>

        Dashboard

    </a>

    <!-- USERS -->
    <a href="/admin/users"
       class="{{ request()->is('admin/users*') ? 'active' : '' }}">

        <i class="bi bi-people"></i>

        Users

    </a>

    <!-- PRODUCTS -->
    <a href="/admin/products"
       class="{{ request()->is('admin/products*') ? 'active' : '' }}">

        <i class="bi bi-box-seam"></i>

        Products

    </a>

    <!-- ORDERS -->
    <a href="/admin/orders"
       class="{{ request()->is('admin/orders*') ? 'active' : '' }}">

        <i class="bi bi-cart-check"></i>

        Orders

    </a>

    <!-- DELIVERY -->
    <a href="/admin/delivery"
       class="{{ request()->is('admin/delivery*') ? 'active' : '' }}">

        <i class="bi bi-truck"></i>

        Delivery

    </a>

    <!-- 🐾 PET REMINDERS -->
    <a href="/admin/pet-reminders"
       class="{{ request()->is('admin/pet-reminders*') ? 'active' : '' }}">

        <i class="bi bi-heart-pulse"></i>

        Pet Reminders

    </a>

    <!-- CONTACTS -->
    <a href="/admin/contacts"
       class="{{ request()->is('admin/contacts*') ? 'active' : '' }}">

        <i class="bi bi-envelope"></i>

        Contacts

    </a>

    <!-- FEEDBACK -->
    <a href="/admin/feedbacks"
       class="{{ request()->is('admin/feedbacks*') ? 'active' : '' }}">

        <i class="bi bi-chat-dots"></i>

        Feedback

    </a>

</div>


<!-- CONTENT -->
<div class="content">

<!-- TOPBAR -->
<div class="topbar d-flex justify-content-between align-items-center px-4 py-2 shadow-sm">

    <div class="d-flex align-items-center gap-3">

        <h5 class="mb-0 fw-bold">
            @yield('title')
        </h5>

        <form method="GET"
              action="{{ url()->current() }}"
              class="d-flex gap-2">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control form-control-sm search-input"
                placeholder="Search"
            >

            <button class="btn btn-primary btn-sm px-3">

                Search

            </button>

        </form>

    </div>

    <div class="d-flex align-items-center gap-4">

        <!-- NOTIFICATIONS -->
        <div class="dropdown">

            <a data-bs-toggle="dropdown"
               class="position-relative text-dark">

                <i class="bi bi-bell fs-5"></i>

                <span id="notif-count"
                      class="badge bg-danger position-absolute top-0 start-100 translate-middle">

                    0

                </span>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow"
                id="notif-list">

                <li class="dropdown-item text-muted">

                    Loading...

                </li>

            </ul>

        </div>

        <!-- ADMIN -->
        <div class="d-flex align-items-center gap-3">

            <strong>
                👋 Admin
            </strong>

        </div>

    </div>

</div>


<!-- MAIN CONTENT -->
<div class="main-content">

    @yield('content')

</div>

</div>


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

function loadNotifications() {

    fetch('/admin/notifications')

        .then(res => res.json())

        .then(data => {

            let list = document.getElementById('notif-list');

            let count = document.getElementById('notif-count');

            if (!list || !count) return;

            list.innerHTML = '';

            count.innerText = data.length;

            if (data.length === 0) {

                list.innerHTML = `
                    <li class="dropdown-item">
                        No new orders
                    </li>
                `;

                return;
            }

            data.forEach(order => {

                list.innerHTML += `
                    <li>
                        <a class="dropdown-item"
                           href="/admin/orders/${order.id}">

                            🛒 Order #${order.id}<br>

                            <small>
                                ${order.status}
                                •
                                ${new Date(order.created_at).toLocaleString()}
                            </small>

                        </a>
                    </li>
                `;

            });

        })

        .catch(err => console.error(err));

}

setInterval(loadNotifications, 5000);

loadNotifications();

</script>

</body>
</html>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <form action="{{ route('customer.logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-link">Logoutd</button>
        </form>
    </div>
</aside>

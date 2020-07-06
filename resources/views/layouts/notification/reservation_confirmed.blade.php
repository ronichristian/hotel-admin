<a href="{{ url('admin_bookings') }}" class="dropdown-item">
    <i class="fas fa-envelope mr-2"></i>
    Reservation from 
    {{ $notification->data['bookToConfirm']['last_name'] }}, 
    <span class="float-right text-muted text-sm">3 mins</span>
</a>
<div class="dropdown-divider"></div>
<template>
   <div>
        <a :href="bookingUrl" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>
            Reservation from 
            {{ unread.data.booking }}, 
            <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
    </div>
</template>

<script>
export default {
    props: ['unread'],
    data(){
        return {
            bookingUrl: ""
        }
    },
    mounted(){
        this.bookingUrl="admin_bookings";
    }
}
</script>
<template>
    <li class="nav-item dropdown" @click="markNotificationAsRead">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">{{ unreadNotifications.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ unreadNotifications.length }} Notifications</span>
            <div class="dropdown-divider"></div>
            <notification-item v-for="unread in unreadNotifications" v-bind:key="unread.id" :unread="unread"></notification-item>
        </div>
    </li> 
</template>

<script>
import NotificationItem from './NotificationItem.vue';
export default {
    name: 'notification',
    props:['unreads', 'userid'],
    components: {NotificationItem},
    data(){
        return{
            unreadNotifications: this.unreads,
        }
    },
    mounted(){
        Echo.private('App.User.' + this.userid)
        // .notification((notification) => {
        .listen(".\\Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", (notification) => {
            toastr.info("Incoming Reservation");
            let newUnreadNotifications = {
                data:
                    {
                        booking:notification.bookToConfirm.last_name
                    }
            }
            this.unreadNotifications.push(newUnreadNotifications);
        })
    },
    methods:{
        markNotificationAsRead(){
            if(this.unreadNotifications.length)
            {
                axios.get('markAsRead');
            }
        }

    },
}
</script>
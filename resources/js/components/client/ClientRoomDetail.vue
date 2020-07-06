<template>
    <div style="margin-top:6%;" class="container">
        <div class="row mb-5">
            <!-- Book Date Modal -->
            <div class="modal fade" id="bookRoom" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 700; color:green;">{{ r[0].category_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="bookNow">
                                <div class="form-group">
                                    <HotelDatePicker 
                                        @check-in-changed="setCheckinDate"
                                        @check-out-changed="setCheckoutDate">
                                    </HotelDatePicker>
                                    <!-- <label>Check In Date</label>
                                    <input v-bind:key="booking.id" v-model="booking.check_in" name="check_in" type="date" class="form-control" required>
                                    <label>Check In Date</label>
                                    <input v-bind:key="booking.id" v-model="booking.check_out" name="check_out" type="date" class="form-control" required> -->
                                    <label>Number Of Rooms</label>
                                    <input v-bind:key="booking.id" v-model="booking.number_of_rooms" name="room_id" type="text" class="form-control" required> 
                                </div>
                                <button type="submit" class="btn btn-primary">Reserve Room</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: -8%;" class="col-md-12 mb-5">
                <div class="block-3 d-md-flex">
                    <div class="image order-1" style="background-image: url('/css/client/images/img_1.jpg'); "></div>
                    <div class="text">
                        <h2 style="color:green; font-weight:500;" class="heading">{{ r[0].category_name.toUpperCase() }}</h2>
                        <div class="price"><sup>$</sup><span class="number">{{ r[0].room_rate }}</span><sub>/per night</sub></div>
                        <ul class="specs mb-5">
                            <li><strong>Facilities:</strong> {{ r[0].facilities }}</li>
                            <li><strong>Capacity:</strong> {{ r[0].persons }}</li>
                            <li><strong>  Payment Upon Check in</strong></li>
                            <li><strong>Check-in time is 2PM and Check-out is 12NN:</strong></li>
                            <li style="font-weight:700;" ><strong class="text-danger">{{ r[0].count_room }} Room(s)</strong>  </li>
                            
                        </ul>
                        <p>
                            <a :href="'/'" class="btn btn-primary py-3 px-5">Book Now</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker'

export default {
    components: { HotelDatePicker },
    props: ['r', 'room_cat_id'],

    data(){
        return{
            booking: {
                booking_id: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
                number_of_rooms: '',
                status: '',
                check_in: '',
                check_out: '',
                total: '',
                user_id: '',
            },
            user: {
                id: '',
                name: '',
            },
            category_name: '',
            count_room: '',
        }
    },

    mounted(){
        this.user.id = Vue.prototype.$userId;
    },

    methods: {
        setCheckinDate(newDate) {
            let date = newDate;
            let formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
            this.booking.check_in = formatted_date;
        },
         setCheckoutDate(newDate) {
            let date = newDate;
            let formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
           this.booking.check_out = formatted_date;
        },

        bookNow(){
            swal({
                title: "Are you sure?",
                text: "Confirm your Booking",
                icon: "info",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post('/api/book_room', this.booking)
                        .then(res => {
                            this.booking.check_in = '';
                            this.booking.check_out = '';
                            this.booking.number_of_rooms = '';
                            swal("Success", "Booking Reservation Sent", "success");
                            window.location.href = `/reservation_sent/${res.data.booking_id}`
                        }).catch(err => {
                        console.log(err)
                    })
                }
            });
            
        },

        book(room){
            this.count_room = room[0].count_room;
            this.booking.user_id = this.$userId;
            this.booking.room_cat_id = room[0].room_cat_id;
            this.booking.room_rate = room[0].room_rate;
            this.booking.number_of_rooms = room.number_of_rooms;
            this.category_name = room[0].category_name;
        }
    }
}
</script>
<template>
    <div style="margin-top:-15%; background-color:#faf4f4; border-radius:5px;" class="container">
        <div class="row mb-5 pt-5 justify-content-center">
            <h2 class="heading">Accomodation Services</h2>
        </div>
        <div class="modal fade" id="bookRoom" tabindex="-1" role="dialog" aria-hidden="true">
            <div style="width: 100%;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 700; color:green;">{{ category_name.toUpperCase() }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="bookNow">
                            <div class="form-group">
                                <HotelDatePicker 
                                    format="YYYY/MM/DD"
                                    @check-in-changed="setCheckinDate"
                                    @check-out-changed="setCheckoutDate">
                                </HotelDatePicker>
                                
                                <label>Number Of Rooms</label>
                                <input v-bind:key="booking.id" v-model="booking.number_of_rooms" name="room_id" type="text" class="form-control" required>
                            </div>
                            <button v-if="booking.number_of_rooms <= count_room" type="submit" class="btn btn-primary">Submit</button>
                            <button v-else disabled type="submit" class="btn btn-primary">Reserve Room</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div v-for="(room) in rooms" v-bind:key="room.id" class="col-lg-3 mb-5">
                <div style="max-height: 500px; min-height:470px; background-color:#ededed; " class="block-34">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div style="padding:10px;" class="block-31 d-md-flex">
                               <a :href="'/room_detail/' + room.id" ><img style="border-radius:5px; height:180px; width:230px;" src="css/client/images/img_1.jpg" alt="Image placeholder"></a>
                            </div>  
                        </div>
                    </div>
                    <div style="margin-top:-5%;" class="text">
                         <div class="text">
                            <div class="media-body">
                                <ul class="specs">
                                    <h4 style="font-weight:500;" class="heading"><a style=" color:#21bf73;" :href="'/room_detail/' + room.id">{{room.category_name}}</a></h4>
                                    <li><strong>{{room.facilities}}</strong></li>
                                </ul>
                            </div>
                        </div>
                        <ul class="specs">
                            <!-- <li><strong> Closet with hangers, HD flat-screen TV, Telephone </strong></li> -->
                        </ul>
                        <div class="price">
                            <!-- <button @click="book(room)" class="btn btn-primary py-3" data-toggle="modal" data-target="#bookRoom">Book Now</button> -->
                            <!-- <a :href="'/room_detail/' + room.id" class="btn btn-primary" >Book Now</a> -->
                            <sup>P</sup><span class="number">{{room.room_rate}}</span><sub>/per night</sub>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
// import datePicker from 'vuejs-datepicker';
import HotelDatePicker from 'vue-hotel-datepicker'

export default {
    components: { HotelDatePicker },
     data(){
        return{
            rooms: [],
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
        this.displayRooms();
        this.user.id = Vue.prototype.$userId;
    },

    methods: {
        
        displayRooms(){
            fetch('api/display_rooms', {
                method: 'get'
            })
            .then(res => res.json())
            .then(res => {
                this.rooms = res.data;
            })
        },

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
                        swal("Success", "Booking Reservation Sent", "success");
                        window.location.href = `/reservation_sent/${res.data.booking_id}`
                    })
                    .catch(err => {
                        console.log(err)
                    })
                }
            });
            
        },

        book(room){
            this.count_room = room.count_room;
            this.booking.user_id = this.$userId;
            this.booking.room_cat_id = room.id;
            this.booking.room_rate = room.room_rate;
            this.booking.number_of_rooms = room.number_of_rooms;
            this.category_name = room.category_name;
        },

    }
}
</script>
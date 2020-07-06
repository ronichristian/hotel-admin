<template>
    <div class="container">
        <!-- Book Now Modal -->
        <div class="modal fade bd-example-modal-xl" id="bookRoom" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:1000px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 700; color:green;">{{ category_name.toUpperCase() }}</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form-wizard @on-complete="onComplete"
                                    color="#0c9463"
                                    title=""
                                    subtitle=""
                                    validate-on-back
                                    :start-index.sync="activeTabIndex"
                                    shape="circle" >
                                <tab-content title="Personal details" icon="ti-user" :before-change="() => validate('firstStep')">
                                <!-- <tab-content title="Personal details" icon="ti-user"> -->
                                    <first-step :date_start="this.date_start" 
                                                :date_end="this.date_end" 
                                                :number_of_rooms="this.number_of_rooms" 
                                                :room_cat_id="this.booking.room_cat_id" 
                                                :room_rate="this.booking.room_rate" 
                                                ref="firstStep" 
                                                @on-validate="onStepValidate">
                                    </first-step>
                                </tab-content>
                                <tab-content title="Additional details" icon="ti-menu">
                                    <second-step :date_start="this.date_start" 
                                                :date_end="this.date_end" 
                                                :number_of_rooms="this.number_of_rooms" 
                                                :category_name="this.category_name" 
                                                :room_rate="this.booking.room_rate" 
                                                :nights="this.nights" 
                                                ref="secondStep" >
                                    </second-step>
                                </tab-content>
                                <tab-content title="Last step" icon="ti-check">
                                            Your data
                                        <!-- <pre v-html="prettyJSON"></pre> -->
                                </tab-content>
                            </form-wizard>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-5">
            <div style="background-color:#ededed; border-shadow: 5px 5px 5px 5px;" class="block-3 d-md-flex">
                <div style="height:40px;" class="col-md-12 text-center section-heading">
                    <h2 class="heading" style="color:#0c9463; font-size: 30px; font-weight:500;">
                        AVAILABLE ROOMS
                    </h2>
                </div>
            </div>  
        </div>  
        <div style="margin-top:-13%; background-color: #0c9463; padding-top:-100px;" class="site-section ">
            <div class="container">
                <div class="row mb-1">

                    <div style="" class="col-md-4 mb-5">
                        <div style="border-shadow: 5px 5px 5px 5px; border-radius:5px;" class="block-3 mb-1">
                            <div style="background-color:#ededed;"  class="sidebar-box">
                                <div class="categories">
                                    <h3>RESERVATION DETAILS</h3><hr>
                                    <li>
                                        <a href="#">
                                            Check in: 
                                            <strong class=" float-right" style="color:green;">{{ this.date_start | moment("dddd, MMMM Do YYYY")  }}</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Check out: 
                                            <strong class=" float-right" style="color:green;">{{ this.date_end | moment("dddd, MMMM Do YYYY")  }}</strong>
                                        </a>
                                    </li>
                                    <li><a href="#">Total Nights: <strong class=" float-right" style="color:green;">{{ this.nights  }}</strong></a></li>
                                    <li><a href="#">No. of Rooms: <strong class=" float-right" style="color:green;">{{ this.number_of_rooms  }}</strong></a></li>
                                </div>
                            </div>
                        </div>  
                    </div>  
                    
                    <div class="col-md-8 mb-8">
                        <div class="row">
                            <div style="background-color:#ededed;" v-for="(room, index) in r" v-bind:key="room.room_cat_id" class="col-md-12 mb-1">
                                <div style="background-color:#ededed;" class="block-3 d-md-flex">
                                    <a href="#"><img style="padding-top:40px; padding-left:10px; height:320px; width:350px; border-shadow:5px 5px 5px; border-radius: 10px;" src="'css/client/images/img_1.jpg" alt="Image placeholder"></a>
                                    <div style="margin-top:-6%;" class="text">
                                        <h2 style="color: green;" class="heading">{{ r[index].category_name }}</h2>
                                        <div style="margin-top:-10%;" class="price">
                                            <sup>P</sup><span style="color:red;" class="number">{{ r[index].room_rate }}</span><sub>/per night</sub>
                                        </div>
                                        <ul style="margin-top:-1%;" class="specs">
                                            <!-- <li><strong>Room(s):</strong> {{r[index].count_room}}</li> -->
                                            <li><strong>Person(s):</strong> {{r[index].persons}}</li>
                                            <li><strong>Facilities:</strong>  {{ r[index].facilities }} </li>
                                            <li><strong>  Payment Upon Check in</strong></li>
                                            <li><strong>Check-in time is 2PM and Check-out is 12NN:</strong></li>
                                            <button @click="book(room)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bookRoom">Book Now</button>
                                        </ul>
                                    </div>
                                    <hr><hr>
                                </div> 
                            </div>
                        </div>
                    </div> 


                </div>
            </div>
        </div>

    </div>
</template>

<script>
// import VueFormGenerator from "vue-form-generator";

import Vue from "vue";
import Element from 'element-ui'
import FormWizard from 'vue-form-wizard'
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import locale from 'element-ui/lib/locale/lang/en'
import FirstStep from "./../FormSteps/FirstStep.vue";
import SecondStep from "./../FormSteps/SecondStep.vue";

Vue.use(Element, { locale })
Vue.use(FormWizard);
Vue.config.productionTip = false;

export default {
    components: { FirstStep, SecondStep },
    props: ['rooms', 'r', 'nights', 'date_start', 'date_end', 'number_of_rooms'],
    data(){
        return {
            finalModel: {},
            activeTabIndex: 0,
            errorMsg: '',
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
            guest_detail:{
                first_name: '',
                last_name: '',
                mi: '',
                address: '',
                contact: '',
                id_number: '',
                status: '',
                nationality: '',
                gender: '',
                purpose: ''
            },
            user: {
                id: '',
                name: '',
            },
            DatePickerFormat: "dd/MM/yyyy",
            disabledDates: {
                to: new Date(Date.now() - 8640000)
            },
            category_name: '',
            room_rate: '',
            count_room: '',
        }
    },
    mounted(){
        this.user.id = Vue.prototype.$userId;
    },
    methods: {
        validate(ref) {
            return this.$refs[ref].validate();
        },
        onStepValidate(validated, model) {
            if (validated) {
                this.finalModel = { ...this.finalModel, ...model };
            }
        },
        onComplete (){
            this.finalModel.room_cat_id = this.booking.room_cat_id;
            this.finalModel.room_rate = this.booking.room_rate;
            this.bookNow();
            setTimeout(function(){

            }, 1000);
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
                    axios.post('/api/book_room', this.finalModel)
                    .then(res => {
                        swal("Success", "Booking Reservation Sent", "success");
                        window.location.href = `/reservation_sent/${res.data.bookings.id}`
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },
        book(room){
            this.booking.user_id = this.$userId;

            this.category_name = room.category_name;
            this.room_rate = room.category_name;
            this.count_room = room.count_room;

            this.booking.number_of_rooms = this.number_of_rooms;
            this.booking.check_in = this.date_start;
            this.booking.check_out = this.date_end;
            this.booking.room_rate = room.room_rate;
            this.booking.room_cat_id = room.room_cat_id;
        }
    }
}
</script>


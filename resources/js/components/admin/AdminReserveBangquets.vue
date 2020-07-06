<template>
    <div class="demo-app">
        
        <!-- BANGQUET RESERVATION UPDATE MODAL  -->
        <div class="modal modal fade bd-example-modal-xl" id="bangquetReservationDetail" tabindex="-1" role="dialog" aria-hidden="true">
            <div style="max-width: 90%;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="bangquetReservationUpdate">
                            <div class="row">
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Event Name</label>
                                    <input type="text" v-model="bangquet_reservation.event_name" name="event_name" class="form-control" placeholder="Event Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Engager's Name</label>
                                    <input type="text" v-model="bangquet_reservation.engager_name" name="engager_name" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Address</label>
                                    <input type="text" v-model="bangquet_reservation.address" name="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Company/Group</label>
                                    <input type="text" v-model="bangquet_reservation.company" name="company" class="form-control" placeholder="Company Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Address</label>
                                    <input type="text" v-model="bangquet_reservation.company_address" name="company_address" class="form-control" placeholder="Address">
                                </div>

                                <hr>
                                <br>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Phone Number</label>
                                    <input type="number" v-model="bangquet_reservation.phone_number" name="phone_number" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Email Address</label>
                                    <input type="email" v-model="bangquet_reservation.email_address" name="email_address" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>No. of Pax</label>
                                    <input type="number" v-model="bangquet_reservation.no_of_pax" name="no_of_pax" class="form-control" placeholder="No. of Pax">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Motif</label>
                                    <input type="text" v-model="bangquet_reservation.motif" name="motif" class="form-control" placeholder="Motif">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Date of Event</label>
                                    <!-- <input type="date" v-model="bangquet_reservation.date_of_event" name="date_of_event" class="form-control datetimepicker-input" data-target="#reservationdate"> -->
                                    <datetime
                                        class="form-control"
                                        type="datetime"
                                        v-model="bangquet_reservation.date_of_event"
                                        input-class="my-class"
                                        zone="local"
                                        value-zone="local"
                                        :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit', timeZoneName: 'short' }"
                                        :phrases="{ok: 'Continue', cancel: 'Exit'}"
                                        :minute-step="15"
                                        :week-start="7"
                                        use12-hour
                                        auto
                                        >
                                        </datetime>
                                </div>
                                
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Start Time of Event</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <vue-timepicker v-model="bangquet_reservation.date_of_event" format="HH:mm:ss"></vue-timepicker>
                                    </div>
                                </div>

                                <!-- <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>End Time of Event</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" v-model="bangquet_reservation.end_time" class="form-control datetimepicker-input" data-target="#timepicker">
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Room Name</label>
                                    <select v-model="bangquet_reservation.venue" name="venue" class="form-control" >
                                        <option disabled></option>
                                        <option v-for="venue in this.venues" :key="venue.id" :value="venue.id">
                                            {{venue.service_name}}
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <br>
                            <button style="margin-left: 51%;" type="submit" class="btn btn-primary btn-sm">
                                Submit
                            </button>
                            
                        </form>
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bangquet Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="bangquetPayment">
                            <div class="row">
                               
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Total Payable</label>
                                    <input type="text" v-model="bangquet_payment.total_payable" name="balance" class="form-control" placeholder="Balance">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Amount</label>
                                    <input type="text" v-model="bangquet_payment.amount" name="balance" class="form-control" placeholder="Balance">                           
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Balance</label>
                                    <input type="text" v-model="bangquet_payment.balance" name="balance" class="form-control" placeholder="Balance">                           
                                </div>

                            </div>
                            <br>
                            <button v-if="bangquet_reservation.paid_status == 0" @click="bangquetPayment" style="margin-left: 51%;" type="submit" class="btn btn-primary btn-sm">
                                Payment 
                            </button>
                            <button v-else @click="bangquetPayment" style="margin-left: 51%;" type="submit" class="btn btn-success btn-sm">
                                Update Payment 
                            </button>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger btn-sm float-left">
                            <i class="fa fa-trash"></i>
                            Delete Booking
                        </button>
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>


        <div class="modal modal fade bd-example-modal-xl" id="bangquetPayment" tabindex="-1" role="dialog" aria-hidden="true">
            <div style="max-width: 90%;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="bangquetReservation">
                            <div class="row">
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Event Name</label>
                                    <input type="text" v-model="bangquet_reservation.event_name" name="event_name" class="form-control" placeholder="Event Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Engager's Name</label>
                                    <input type="text" v-model="bangquet_reservation.engager_name" name="engager_name" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Address</label>
                                    <input type="text" v-model="bangquet_reservation.address" name="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Company/Group</label>
                                    <input type="text" v-model="bangquet_reservation.company" name="company" class="form-control" placeholder="Company Name">
                                </div>
                                <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                    <label>Address</label>
                                    <input type="text" v-model="bangquet_reservation.company_address" name="company_address" class="form-control" placeholder="Address">
                                </div>

                                <hr>
                                <br>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Phone Number</label>
                                    <input type="number" v-model="bangquet_reservation.phone_number" name="phone_number" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Email Address</label>
                                    <input type="email" v-model="bangquet_reservation.email_address" name="email_address" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>No. of Pax</label>
                                    <input type="number" v-model="bangquet_reservation.no_of_pax" name="no_of_pax" class="form-control" placeholder="No. of Pax">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Motif</label>
                                    <input type="text" v-model="bangquet_reservation.motif" name="motif" class="form-control" placeholder="Motif">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Date of Event</label>
                                    <!-- <datetime type="datetime" v-model="bangquet_reservation.date_of_event" use12-hour></datetime> -->
                                    <datetime
                                        type="datetime"
                                        v-model="bangquet_reservation.date_of_event"
                                        input-class="my-class"
                                        zone="local"
                                        value-zone="local"
                                        :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit', timeZoneName: 'short' }"
                                        :phrases="{ok: 'Continue', cancel: 'Exit'}"
                                        :minute-step="15"
                                        :week-start="7"
                                        use12-hour
                                        auto
                                        >
                                        </datetime>
                                </div>
                                
                                <!-- <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Start Time of Event</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                      <datetime type="datetime" v-model="bangquet_reservation.start_time" use12-hour></datetime>
                                    </div>
                                </div> -->

                                <!-- <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>End Time of Event</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" v-model="bangquet_reservation.end_time" class="form-control datetimepicker-input" data-target="#timepicker">
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Room Name</label>
                                    <select v-model="bangquet_reservation.venue" name="venue" class="form-control" >
                                        <option disabled></option>
                                        <option v-for="venue in this.venues" :key="venue.id" :value="venue.id">
                                            {{venue.service_name}}
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <br>
                            <button style="margin-left: 51%;" type="submit" class="btn btn-primary btn-sm">
                                Submit
                            </button>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger btn-sm float-left">
                            <i class="fa fa-trash"></i>
                            Delete Booking
                        </button>
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
        

        <div class="content-header">
            <!-- CHECK IN MODAL -->
            <checkin :room_categories="room_categories" :calendarEvents="calendarEvents"/>
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Bangquet Reservation</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Bangquet Reservation</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 

        <div class="demo-app-top">
            <button style="margin-left: 1.5%; margin-top: -3%" data-toggle="modal" data-target="#bangquetPayment" class="btn btn-info btn-sm">Reserve Bangquet</button>
        </div>

        <FullCalendar
            style="margin-top:-5%;"
            class="demo-app-calendar"
            ref="fullCalendar"
            defaultView="timeGridDay"
            :header="{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,timeGridDay,listWeek'
            }"
            :plugins="calendarPlugins"
            :weekends="calendarWeekends"
            :events="calendarEvents"
            :selectable="true"
            @eventClick="handleSelect"
        />
    </div>
</template>

<script>
import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'

Vue.use(Datetime)

 
// CSS
import 'vue2-timepicker/dist/VueTimepicker.css'
import VueTimepicker from 'vue2-timepicker'

import Vue from "vue";
import Element from 'element-ui'
import FormWizard from 'vue-form-wizard'
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import locale from 'element-ui/lib/locale/lang/en'
import BangquetFirstStep from "./../FormSteps/BangquetFirstStep.vue";
// import CheckInSecondStep from "./../FormSteps/CheckInSecondStep.vue";

import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from '@fullcalendar/list';

// must manually include stylesheets for each plugin
import "@fullcalendar/core/main.css";
import "@fullcalendar/daygrid/main.css";
import "@fullcalendar/timegrid/main.css";

Vue.use(Element, { locale })
Vue.use(FormWizard);
Vue.config.productionTip = false;
export default {
    props: ['room_categories'],
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        BangquetFirstStep,
        VueTimepicker,
    },
    data: function() {
        return {
            data: [],
            selected: '',
            venues: [],
            calendarPlugins: [
                dayGridPlugin,
                timeGridPlugin,
                interactionPlugin, // needed for dateClick
                listPlugin,
            ],
            calendarWeekends: true,
            calendarEvents: [],
            bangquet_reservations: [],
            bangquet_reservation : {
                id: '',
                event_name: '',
                engager_name: '',
                address: '',
                company: '',
                company_address: '',
                venue: '',
                status: '',
                paid_status: '',
                phone_number: '',
                email_address: '',
                date_of_event: '',
                start_time: '',
                end_time: '',
                no_of_pax: '',
                motif: '',
            },
            bangquet_payment: {
                bangquet_id: '',
                total_payable: '',
                amount: '',
                balance: '',
            }
        };
    },

    created(){
        this.getVenues();
        this.fetchData();
    },

    methods: {
        bangquetPayment(){
            swal({
                title: "Are you sure?",
                text: "Confirm To Update Booking",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post('/api/bangquet_payment', this.bangquet_payment)
                    .then(res => { 
                        this.calendarEvents = [];
                        this.fetchData();
                        $("#bangquetReservationDetail").modal('hide');
                        swal("Success", "Bangquet Booking Updated", "success");
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        bangquetReservationUpdate(){
            swal({
                title: "Are you sure?",
                text: "Confirm To Update Booking",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put('/api/bangquetReservationUpdate', this.bangquet_reservation)
                    .then(res => {
                        $("#bangquetReservationDetail").modal('hide');
                        swal("Success", "Bangquet Booking Updated", "success");
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        bangquetReservation(){
            axios.post('/api/reserve_bangquet', this.bangquet_reservation)
            .then(data => {
                this.bangquet_reservation.event_name = '';
                this.bangquet_reservation.engager_name = '';
                this.bangquet_reservation.address = '';
                this.bangquet_reservation.company = '';
                this.bangquet_reservation.company_address = '';
                this.bangquet_reservation.status = '';
                this.bangquet_reservation.phone_number = '';
                this.bangquet_reservation.email_address = '';
                this.bangquet_reservation.date_of_event = '';
                this.bangquet_reservation.start_time = '';
                this.bangquet_reservation.no_of_pax = '';
                this.bangquet_reservation.motif = '';
                swal("Success", "Bangquet Booking Successful", "success");
            })
            .catch(errors => {
                toastr.error("Error", "Oops something room", "error");
            });
        },

        handleSelect(e){
            $("#bangquetReservationDetail").modal();
            var id = e.event._def.extendedProps.eventID
            axios.get('/api/get_bangquet_reservation/'+id)
            .then(res => {
                this.bangquet_reservations = res.data.data;
                this.bangquet_reservation.id = this.bangquet_reservations[0].id;
                this.bangquet_reservation.event_name = this.bangquet_reservations[0].event_name;
                this.bangquet_reservation.engager_name = this.bangquet_reservations[0].engager_name;
                this.bangquet_reservation.address = this.bangquet_reservations[0].address;
                this.bangquet_reservation.company = this.bangquet_reservations[0].company;
                this.bangquet_reservation.company_address = this.bangquet_reservations[0].company_address;
                this.bangquet_reservation.venue = this.bangquet_reservations[0].venue;
                this.bangquet_reservation.phone_number = this.bangquet_reservations[0].phone_number;
                this.bangquet_reservation.email_address = this.bangquet_reservations[0].email_address;
                this.bangquet_reservation.date_of_event = this.bangquet_reservations[0].date_of_event;
                this.bangquet_reservation.start_time = this.bangquet_reservations[0].start_time;
                this.bangquet_reservation.no_of_pax = this.bangquet_reservations[0].no_of_pax;
                this.bangquet_reservation.motif = this.bangquet_reservations[0].motif;

                this.bangquet_reservation.paid_status = this.bangquet_reservations[0].paid_status;
                
                this.bangquet_payment.bangquet_id = this.bangquet_reservations[0].id;

                console.log(this.bangquet_reservations[0].date_of_event)
            })
            .catch(err => {
                console.log(err)
            })
        },

        fetchData(){
            axios.get('/api/get_bangquet_reservations')
            .then(res => {
                this.data = res.data.data;
                var color = '';
                var room_no = '';
                for(var i=0; i < this.data.length; i++){
                    //#0275d8 - blue
                    //#5cb85c - green
                    //#d9534f - red
                    //#f0ad4e - yellow
                    if(this.data[i].status == 'occupied' && this.data[i].paid_status == 1){
                        color = '#0275d8';
                    }else if (this.data[i].status == 'occupied' && this.data[i].paid_status == 0){
                        color = '#d9534f';
                    }

                    this.calendarEvents.push(
                        {
                            color: color,
                            title: 'Venue - ' + this.data[i].service_name,
                            url: '#', 
                            start: new Date(this.data[i].date_of_event),
                            eventID: this.data[i].id
                        }
                    )
                }
            })
            .catch(err => {
                console.log(err)
            })
        },

        getVenues(){
            axios.get('/api/get_venues')
            .then(res => {
                this.venues = res.data.data
            })
            .catch(err => {
                console.log(err)
            })
        },

        dispatch (e) {
            this.$emit('input', e)
            this.selected = e
        },
      
    }
};
</script>

<style>
    .demo-app {
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    .demo-app-top {
        margin: 0 0 3em;
    }

    .demo-app-calendar {
        margin: 0 auto;
        font-size:50px;
        max-width: 100%;
    }
</style>

<template>

<div class="col-md-12">
    <!-- PAYMENT -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-hidden="true">
        <div style="max-width: 60%;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment<span style="color:green;"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="payment" class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Invoice No.</label>
                            <div class="col-sm-2">
                                <p class="form-control"> {{ id }} </p>
                            </div>

                            <label for="inputEmail" class="col-sm-1 col-form-label">Date</label>
                            <div class="col-sm-2">
                                <p class="form-control"> {{ today_date }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Guest Name</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ name }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Other Charges</label>
                            <div class="col-sm-10">
                                <div v-for="charge in charges" v-bind:key="charge.id" class="form-check">
                                    <input @change="computeTotalCharges" class="form-check-input" type="checkbox" :value="charge" v-model="checkedPrices">
                                    <label class="form-check-label" for="defaultCheck1">
                                       {{charge.charge_name}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Payment Due</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ total }} </p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input v-model="booking_payment.amount_recieved" name="payment" type="number" class="form-control" placeholder="Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button v-if="paid_status == 0" type="submit" class="btn btn-info">Submit</button>
                                <button v-else type="submit" @click="updatePayment" class="btn btn-success">Submit</button>

                                <button v-if="paid_status == 0" style="display:none;">
                                    <span >OCCUPIED</span>
                                </button>
                                <button v-else type="button" class="btn btn-success float-right">
                                    <span class="badge badge-success">Paid</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CHECK OUT -->
    <div class="modal fade" id="checkOut" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Available Rooms in <span style="color:green;"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="payment" class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Invoice No.</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ id }} </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ today_date }} </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Guest Name</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ name }} </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <p class="form-control"> {{ total }} </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Recieved</label>
                            <div class="col-sm-10">
                                <input v-model="booking_payment.amount_recieved" name="amount_recieved" type="number" class="form-control" placeholder="Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="button" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ACCEPT BOOKING -->
    <div class="modal fade" id="acceptBooking" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Available Rooms in <span style="color:green;"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Room Name</th>
                                <th>Room No.</th>
                                <th>Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="available_room in available_rooms" v-bind:key="available_room.room_no">
                                <td>{{ available_room.category_name }}</td>
                                <td>{{ available_room.room_no }}</td>
                                <td>
                                    <button @click="acceptBooking(available_room)" class="btn btn-info btn-sm">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Details</a></li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#timeline" data-toggle="tab">
                        Payment
                    </a>
                </li> -->
                <div class="col-sm-8" >
                    <button data-toggle="modal" data-target="#payment" class="btn btn-warning btn-md">
                        <i class="fa fa-arrow-right"></i> Payment 
                    </button>
                </div>
            </ul>
            
            
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">

                <div class="tab-pane active" id="activity">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Guest: {{ guest_name }}
                                    <small class="float-right">Date: {{date}}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr style="white-space: nowrap;">
                                            <th align="right">Room name</th>
                                            <th align="right">Rate</th>
                                            <th align="right">Check in Date</th>
                                            <th align="right">Check out Date</th>
                                            <th align="right">Nights</th>
                                            <th align="right">Status</th>
                                            <th align="right">Room NO.</th>
                                            <th align="right">Total cost</th>
                                            <th align="right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="white-space: nowrap;">
                                        <tr v-for="booking_detail in this_booking_details" v-bind:key="booking_detail.id">
                                            <td>{{ booking_detail.category_name }}</td>
                                            <td align="right">{{ booking_detail.room_rate }}</td>
                                            <td align="center">{{ booking_detail.check_in | moment("dddd, MMMM Do YYYY") }}</td>
                                            <td align="center">{{ booking_detail.check_out | moment("dddd, MMMM Do YYYY") }}</td>
                                            <td align="center">{{ booking_detail.nights }}</td>

                                            <td align="center" v-if="booking_detail.status == 'cancelled'" style="font-weight: 700;" class="text-danger">
                                                <span class="badge badge-danger">{{ booking_detail.status }}</span>
                                            </td>
                                            <td align="center" v-else-if="booking_detail.status == 'checkout'" style="font-weight: 700;" class="text-danger">
                                                <span class="badge badge-danger">CHECKED OUT</span>
                                            </td>
                                            <td align="center" v-else-if="booking_detail.status == 'occupied'" style="font-weight: 700;" class="text-primary">
                                                <span class="badge badge-info">{{ booking_detail.status }}</span>
                                            </td>
                                            <td align="center" v-else-if="booking_detail.status == 'pending'" class="text-warning">
                                                <span class="badge badge-warning">{{ booking_detail.status }}</span>
                                            </td>
                                            <td align="center" v-else style="font-weight: 700;" class="text-success">
                                                <span class="badge badge-success">{{ booking_detail.status }}</span>
                                            </td>

                                            <td align="center" v-if="booking_detail.room_no == 0" class="text-secondary">N/A</td>
                                            <td align="center" v-else class="text-success">{{ booking_detail.room_no }}</td>

                                            <td align="right" class="text-danger">{{ booking_detail.total }}</td>
                                            <td>
                                                <button v-if="booking_detail.status == 'pending' " @click="setDetails(booking_detail)" data-toggle="modal" data-target="#acceptBooking" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-arrow-right"></i> Accept
                                                </button>
                                                <button v-if="booking_detail.status == 'pending' " @click="cancel(booking_detail)" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-arrow-right"></i> Reject
                                                </button>
                                                
                                                <button v-else-if="booking_detail.status == 'reserved' " @click="checkIn(booking_detail)" class="btn btn-success btn-sm">
                                                    <i class="fa fa-arrow-right"></i> Check In
                                                </button> 
                                                <button v-else-if="booking_detail.status == 'cancelled'"  class="btn btn-danger btn-sm">
                                                    Cancelled
                                                </button>  
                                                <button v-else-if="booking_detail.status == 'checkout'"  class="btn btn-danger btn-sm">
                                                    Checked Out
                                                </button> 
                                                <span  v-else-if="booking_detail.status == 'occupied' && paid_status == 0" class="badge badge-warning">
                                                    Unpaid
                                                </span>
                                                <button v-else-if="booking_detail.status == 'occupied' && paid_status == 1" @click="checkOut(booking_detail)" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-arrow-right"></i> Check Out
                                                </button> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Total:</th>
                                                <td style="color:red;">P {{ grand_total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="settings">
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['booking_id', 'guest_name', 'grand_total', 'booking_details', 'date', 'grand_total'],
    data(){
        return{
            available_rooms: [],
            booking: [],
            this_booking_details: this.booking_details,
            accepted_booking: {
                confirmed_bookings_id: '',
                booking_detail_id: '',
                booking_id: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
                number_of_rooms: '',
                check_in: '',
                check_out: '',
                nights: '',
                status: '',
                total: '',
            },
            booking_payment: {
                booking_id: '',
                payment: '',
                amount_recieved: '',
            },
            charges: [],
            checkedPrices: [],
            id: this.booking_id,
            name: this.guest_name,
            total: this.grand_total,
            today_date: new Date().toJSON().slice(0,10).replace(/-/g,'/'),
            paid_status: '',
            edit: false,
        }
    },
    mounted(){
        this.getBooking();
        this.getCharges();
    },
    methods: {
        // Compute Total Charges Fee
        computeTotalCharges(){
            var checkedPricesTotal = 0;
            for(var i=0; i < this.checkedPrices.length; i++){
                checkedPricesTotal += this.checkedPrices[i]['charge_price']
            }
            this.total = this.grand_total + checkedPricesTotal;
        },

        // Fetch Charges
        getCharges(){
            axios.get("/api/get_other_charges")
            .then(res => {
                this.charges = res.data.data;
            })
            .catch(err => {
                console.log(err)
            })
        },

        // Fetch Current Booking Detail
        getBooking(){
            axios.get('/api/get_booking/'+this.id)
            .then(res => {
                this.booking = res.data.data;
                this.paid_status = this.booking[0]['paid_status'];
            })
            .catch(err => {
                console.log(err)
            })
        },

        setDetails(booking_detail){
            this.accepted_booking.booking_detail_id = booking_detail.id;
            this.accepted_booking.booking_id = booking_detail.booking_id;
            this.accepted_booking.room_cat_id = booking_detail.room_cat_id;
            this.accepted_booking.room_no = booking_detail.room_no;
            this.accepted_booking.room_rate = booking_detail.room_rate;
            this.accepted_booking.number_of_rooms = booking_detail.number_of_rooms;
            this.accepted_booking.check_in = booking_detail.check_in;
            this.accepted_booking.check_out = booking_detail.check_out;
            this.accepted_booking.nights = booking_detail.nights;
            this.accepted_booking.status = booking_detail.status;
            this.accepted_booking.total = booking_detail.total;
            this.category_name = booking_detail.category_name;
            var me = this;
            axios.post('/api/available_rooms', me.accepted_booking)
            .then(res => {
                this.available_rooms = res.data.data;
            })
            .catch(err => {
                swal("Oops", "Something went wrong", "error");
            })
        },

        updatePayment(){
            this.edit = true;
        },

        payment(){
            swal({
                title: "Are you sure?",
                text: "Confirm to Accept Payment",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    this.booking_payment.booking_id = this.id;
                    this.booking_payment.payment = this.total;
                    var me = this;
                    if(this.edit == false){
                        axios.post('/api/payment', me.booking_payment)
                        .then(res => {
                            this.getBooking();
                            this.booking_payment.payment = ''
                            swal("Confirmed", "Payment Successful", "success");
                        })
                        .catch(err => {
                            swal("Oops", "Something went wrong", "error");
                        })
                        $('#payment').fadeOut().modal('hide');
                    }else{
                        this.edit = false;
                        axios.post('/api/update_payment', me.booking_payment)
                        .then(res => {
                            this.booking_payment.payment = ''
                            swal("Confirmed", "Addtional Payment Successful", "success");
                        })
                        .catch(err => {
                            swal("Oops", "Something went wrong", "error");
                        })
                        $('#payment').fadeOut().modal('hide');
                    }

                }
            });
        },
        

        acceptBooking(available_room){
            this.accepted_booking.room_no  = available_room.room_no
            swal({
                title: "Are you sure?",
                text: "Confirm to Accept Booking",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var me = this;
                    axios.post('/api/accept_booking', me.accepted_booking)
                    .then(res => {
                        axios.get('/api/admin_bookings_details/'+res.data.data.booking_id)
                        .then(res => {
                            this.this_booking_details = res.data.data;
                            swal("Confirmed", "Payment Successful", "success");
                        })
                        .catch(err => {
                            swal("Oops", "Something went wrong!", "errors")
                        })
                        $('#acceptBooking').fadeOut().modal('hide');
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        
        checkOut(booking_detail){
            swal({
                title: "Are you sure?",
                text: 'Confirm To "CHECK OUT" the Room',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put('/api/check_out', booking_detail)
                    .then(res => {
                        console.log(res.data)
                        // Get Booking Details
                        if(res.data == 0){
                            swal("Oops", "Cannot Check Out the Reservation Yet", "error");
                        }
                        else if(res.data == 1){
                            swal("Oops", "Cannot Check Out the Reservation Yet", "error");
                        }else{
                            this.calendarEvents = []
                            this.fetchData();
                            swal("Confirmed", "Reservation Checked Out", "success");
                        }
                        // $('#acceptBooking').fadeOut().modal('hide');
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        checkIn(booking_detail){
            swal({
                title: "Are you sure?",
                text: "Confirm To Check In the Room",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put('/api/check_in', booking_detail)
                    .then(res => {
                        // Get Booking Details
                        if(res.data == 0){
                            swal("Oops", "Cannot Check in the Reservation Yet", "error");
                        }else{
                            axios.get('/api/admin_bookings_details/'+booking_detail.booking_id)
                            .then(res => {
                                this.this_booking_details = res.data.data;
                                swal("Confirmed", "Reservation Checked In", "success");
                            })
                        }
                        $('#acceptBooking').fadeOut().modal('hide');
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
            
        },

        cancel(booking_detail){
            swal({
                title: "Are you sure?",
                text: "Confirm to Reject Reservation",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put('/api/cancel', booking_detail)
                    .then(res => {
                        fetch(`/api/admin_bookings_details/${booking_detail.booking_id}`, {
                            methods: 'get'
                        })
                        .then(res => res.json())
                        .then(res => {
                            this.this_booking_details = res.data.data;
                            swal("Confirmed", "Reservation Canceled", "error");
                        })
                        this.this_booking_details = res.data.data;
                        swal("Confirmed", "Reservation Checked In", "success");
                    })

                    // fetch('/api/cancel', {
                    //     method: 'put',
                    //     body: JSON.stringify(booking_detail),
                    //     headers: {
                    //         'content-type': 'application/json'
                    //     }
                    // })
                    // .then(res => res.json())
                    // .then(res => {
                    //     // Get Details
                    //     fetch(`/api/admin_bookings_details/${booking_detail.booking_id}`, {
                    //         methods: 'get'
                    //     })
                    //     .then(res => res.json())
                    //     .then(res => {
                    //         this.this_booking_details = res.data;
                    //         swal("Confirmed", "Reservation Canceled", "error");
                    //     })
                    // })
                }
            });
        },

        configPagination(data){
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },

    }
}
</script>
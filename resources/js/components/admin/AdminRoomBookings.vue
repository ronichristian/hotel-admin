<template>
    <div class="demo-app">

        <!-- <div class="modal modal fade bd-example-modal-xl" id="bookingDetail" tabindex="-1" role="dialog" aria-hidden="true"> -->
        <div class="modal modal fade bd-example-modal-xl" id="" tabindex="-1" role="dialog" aria-hidden="true">
            <div style="max-width: 90%;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="invoice p-3 mb-3"  style="border: 1px solid black;">

                                <div class="row">
                                    <div class="col-12">
                                        <h4>    
                                        <i class="fas fa-globe"></i> UFLS Homestay
                                            <small class="float-right">
                                                Date: 
                                            </small>
                                        </h4>
                                    </div>
                                </div>

                                <div class="row invoice-info">
                                     <div class="col-sm-4 invoice-col">
                                        <b>Guest Details</b><br>
                                    </div>
                                </div><br>

                                 <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                                <div class="row with-border">
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <label>GUEST DETAILS</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                                <div class="row with-border">
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                                        <p>Puno, Roni Christian C.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                                <div class="row with-border">
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <p>CMU BUKIDNON</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Contact #</label>
                                                    </div>
                                                    <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                        <p>019230123123</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>ID Number</label>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <p>201591312</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Student</label>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <p>check</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12" style="margin-top: -24px;">
                                                <div class="row with-border">
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <label>Purpose of Stay</label>
                                                    </div>
                                                    <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                                        <p> asdasdqweq</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="margin-top: -4px;">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Nationality</label>
                                                    </div>
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <p>asdqweasdqwe</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3" style="margin-top: -4px;">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>No. of Pax</label>
                                                    </div>
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <p>asdqweasdqwe</p>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-3 mb-3 mb-lg-4 col-lg-3" style="margin-top: -4px;">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <p>asdqweasdqwe</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="margin-top: -25px;">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Date of Arrival</label>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <p>2/05/2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="margin-top: -25px;">
                                                <div class="row with-border">
                                                    <div class="col-md-4 mb-4 mb-lg-4 col-lg-4">
                                                        <label>Date of Departure</label>
                                                    </div>
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <p>2/07/2020</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="margin-top: -5px;">
                                                <div class="row with-border">
                                                    <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                        <label>Time</label>
                                                    </div>
                                                    <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                        <p>2/07/2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="margin-top: -5px;">
                                                <div class="row with-border">
                                                    <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                        <label>Time</label>
                                                    </div>
                                                    <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                        <p>2/07/2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                        <div class="row ">
                                            
                                        </div>
                                    </div>
                                 </div>

                                 <br>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                                <div class="row with-border">
                                                    <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                                                        <label>ROOM TYPE & NUMBER</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                                                <div class="row with-border">
                                                    
                                                    <div class="col-md-6 mb-6 mb-lg-12 col-lg-6" style="">
                                                        <div class="row with-border">
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <label>Room Type</label>
                                                            </div>
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <p>Executive</p>
                                                            </div>
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <label>Room Number</label>
                                                            </div>
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <p>101</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-6 mb-lg-6 col-lg-6" style="">
                                                        <div class="row with-border">
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <label>Additionals</label>
                                                            </div>
                                                            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                                                                <p>2/07/2020</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- DETAIL MODAL -->
        <div class="modal modal fade bd-example-modal-xl" id="bookingDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- <div class="modal modal fade bd-example-modal-xl" id="" tabindex="-1" role="dialog" aria-hidden="true"> -->
            <div style="max-width: 90%;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateCurrentBooking">
                            <div class="row">
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Check in Date</label>
                                    <input v-if="booking_detail.status == 'checkout'" disabled type="date" v-model="booking_detail.check_in" class="form-control datetimepicker-input" data-target="#reservationdate">
                                    <input @change="getRoomNos" v-else type="date" v-model="booking_detail.check_in" class="form-control datetimepicker-input" data-target="#reservationdate">
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Check out Date</label>
                                    <input v-if="booking_detail.status == 'checkout'" disabled type="date" v-model="booking_detail.check_out" class="form-control datetimepicker-input" data-target="#reservationdate">
                                    <input @change="getRoomNos" v-else type="date" v-model="booking_detail.check_out" class="form-control datetimepicker-input" data-target="#reservationdate">
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Room Name</label>
                                    <select  v-if="booking_detail.status == 'checkout'" disabled class="form-control" >
                                        <option disabled>{{cat_name}}</option>
                                        <option v-for="room_cat in this.room_categories" :key="room_cat.id" :value="room_cat.id">
                                            
                                        </option>
                                    </select>
                                    <select  v-else  class="form-control" v-model="booking_detail.room_cat_id" @click="getRoomNos()" @change="clearRoomNo()">
                                        <option disabled>{{cat_name}}</option>
                                        <option v-for="room_cat in this.room_categories" :key="room_cat.id" :value="room_cat.id">
                                            {{room_cat.category_name}}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-6 mb-lg-6 col-lg-3">
                                    <label>Room Number</label>
                                    <select v-if="booking_detail.status == 'checkout'" disabled class="form-control" v-model="booking_detail.room_no" required>
                                        
                                    </select>
                                    <select style="font-weight: 700; color:green" v-else class="form-control" v-model="booking_detail.room_no" required>
                                        <option disabled>{{this.roomno}}</option>  
                                        <option v-for="room_number in this.room_numbers" :key="room_number.id">
                                            {{room_number.room_no}}
                                        </option>
                                    </select>
                                </div>

                                
                                <div class="col-md-3 mb-6 mb-lg-6 col-lg-3">
                                    <!-- 
                                        #0275d8 - blue
                                        #5cb85c - green
                                        #d9534f - red
                                        #f0ad4e - yellow
                                     -->
                                    <label>Status</label>
                                    <p v-if="booking_detail.status == 'occupied' && booking_detail.paid_status == 0" 
                                        style="color:#d9534f; font-weight: 800;" 
                                        class="form-control"> 
                                        {{ booking_detail.status }} 
                                        <span class="badge badge-warning float-right">Unpaid</span>
                                    </p>
                                    <p v-else-if="booking_detail.status == 'occupied' && booking_detail.paid_status == 1" 
                                        style="color:#0275d8; font-weight: 800;" 
                                        class="form-control"> 
                                        {{ booking_detail.status }} 
                                        <span class="badge badge-success float-right">Paid</span>
                                    </p>
                                    <p v-else-if="booking_detail.status == 'checkout' && booking_detail.paid_status == 1" 
                                        style="color:#5cb85c; font-weight: 800;" 
                                        class="form-control"> 
                                        {{ booking_detail.status }} 
                                        <span class="badge badge-success float-right">Paid</span>
                                    </p>
                                    <p v-else-if="booking_detail.status == 'pending'" 
                                        style="color:#f0ad4e; font-weight: 600;" 
                                        class="form-control"> 
                                        {{ booking_detail.status }} 
                                    </p>
                                    <p v-else-if="booking_detail.status == 'reserved'" 
                                        style="color:#f0ad4e; font-weight: 600;" 
                                        class="form-control"> 
                                        {{ booking_detail.status }} 
                                    </p>
                                    <p v-else style="color:" class="form-control"> {{ booking_detail.status }} </p>
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Room Rate</label>
                                    <input disabled type="number" v-model="booking_detail.room_rate" class="form-control">
                                    <!-- <input v-if="booking_detail.status == 'checkout'" disabled  type="number" v-model="booking_detail.room_rate" class="form-control">
                                    <input v-else type="number" v-model="booking_detail.room_rate" class="form-control"> -->
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Total</label>
                                    <input disabled type="number" v-model="booking_detail.total" class="form-control">
                                    <!-- <input v-if="booking_detail.status == 'checkout'" disabled  type="number" v-model="booking_detail.total" class="form-control">
                                    <input v-else type="number" v-model="booking_detail.total" class="form-control"> -->
                                </div>
                            </div>
                            <br>
                            <button style="margin-left: 51%;" v-if="booking_detail.status == 'checkout'" disabled type="submit" class="btn btn-primary btn-sm" >Update</button>
                            <button style="margin-left: 51%;" v-else type="submit" class="btn btn-primary btn-sm">
                                Update
                            </button>
                            
                        </form>
                        <br>

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Booking Payment</h5>
                        </div>

                        <form @submit.prevent="payment" class="form-horizontal">
                             <div class="row">
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Invoice No.</label>
                                    <p class="form-control"> {{ id }} </p>
                                </div>
                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Date</label>
                                    <p class="form-control"> {{ today_date }} </p>
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Guest</label>
                                    <p class="form-control"> {{ name }} </p>
                                </div>

                                <div class="col-md-3 mb-6 mb-lg-6 col-lg-3">
                                    <label>Charges</label>
                                    <div class="col-sm-10">
                                        <div v-for="charge in charges" v-bind:key="charge.id" class="form-check">
                                            <input @change="computeTotalCharges(charge)" class="form-check-input" type="checkbox" :value="charge" v-model="checkedPrices">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{charge.charge_name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Total</label>
                                    <input disabled type="number" v-model="this.total" class="form-control">
                                    <!-- <input v-if="booking_detail.status == 'checkout'" disabled  type="number" v-model="booking_detail.total" class="form-control">
                                    <input v-else type="number" v-model="booking_detail.total" class="form-control"> -->
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <!-- <label>Room Rate</label>
                                    <input disabled type="number" v-model="booking_detail.room_rate" class="form-control"> -->
                                    <!-- <input v-if="booking_detail.status == 'checkout'" disabled  type="number" v-model="booking_detail.room_rate" class="form-control">
                                    <input v-else type="number" v-model="booking_detail.room_rate" class="form-control"> -->
                                </div>

                                <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                                    <label>Amount</label>
                                     <input v-model="booking_payment.amount_recieved" name="payment" type="number" class="form-control" placeholder="Amount">
                                </div>
                            </div>

                            <br>

                            <button v-if="paid_status == 0" type="submit" class="btn btn-info btn-sm">Submit</button>
                            <button v-else-if="paid_status == 1 && booking_detail.status == 'checkout'" 
                                type="submit" @click="updatePayment" 
                                class="btn btn-success btn-sm"
                                disabled >
                                Update Payment
                            </button>
                            <button v-else type="submit" @click="updatePayment" 
                                class="btn btn-success btn-sm"> 
                                Update Payment
                            </button>

                            <button v-if="paid_status == 0" style="display:none;">
                                <span >OCCUPIED</span>
                            </button>

                            <button v-else type="button" class="btn btn-success btn-sm">
                                <span class="badge badge-success">Paid</span>
                            </button>
                        </form>

                        <br>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Room name</th>
                                    <th>Room rate</th>
                                    <th>Check in Date</th>
                                    <th>Check out Date</th>
                                    <th>Nights</th>
                                    <th>Status</th>
                                    <th>Room NO.</th>
                                    <th>Total cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="booking_detail in booking_details" v-bind:key="booking_detail.id">
                                    <td align="left">{{ booking_detail.category_name}} </td>
                                    <td align="right">{{ booking_detail.room_rate }} </td>
                                    <td align="center">{{ booking_detail.check_in | moment("dddd, MMMM Do YYYY") }} </td>
                                    <td align="center">{{ booking_detail.check_out | moment("dddd, MMMM Do YYYY")}} </td>
                                    <td align="center">{{ booking_detail.nights }} </td>
                                    
                                    <td align="center" v-if="booking_detail.status == 'cancelled'" style="font-weight: 700;" class="text-danger">
                                        <span class="badge badge-danger">{{ booking_detail.status }}</span>
                                    </td>
                                    <td align="center" v-else-if="booking_detail.status == 'checkout'" style="font-weight: 700;" class="text-danger">
                                        <span class="badge badge-danger">CHECKED OUT</span>
                                    </td>
                                    <td align="center" v-else-if="booking_detail.status == 'occupied' && booking_detail.paid_status == 1" style="font-weight: 700;" class="text-primary">
                                        <span class="badge badge-info">{{ booking_detail.status }}</span>
                                    </td>
                                    <td align="center" v-else-if="booking_detail.status == 'occupied' && booking_detail.paid_status == 0" style="font-weight: 700;" class="text-primary">
                                        <span class="badge badge-warning">Unpaid</span>
                                    </td>
                                    <td align="center" v-else-if="booking_detail.status == 'pending'" class="text-warning">
                                        <span class="badge badge-warning">{{ booking_detail.status }}</span>
                                    </td>
                                    <td align="center" v-else style="font-weight: 700;" class="text-success">
                                        <span class="badge badge-success">{{ booking_detail.status }}</span>
                                    </td>

                                    <td align="center" v-if="booking_detail.room_no == 0"> N/A </td>
                                    <td align="center" v-else>{{booking_detail.room_no}} </td>

                                    <td align="right">{{booking_detail.total}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    

                    <div class="modal-footer">
                        <button v-if="booking_detail.status == 'checkout' || 
                            (booking_detail.status == 'occupied' && booking_detail.paid_status == 0) ||
                            booking_detail.status == 'pending' || booking_detail.status == 'reserved'" 
                            type="button" 
                            class="btn btn-info btn-sm float-left" disabled>
                            <i class="fa fa-arrow-up"></i>
                            Check Out
                        </button>
                        <button v-else type="button" class="btn btn-primary btn-sm float-left" @click="checkOut(booking_detail)">
                            <i class="fa fa-arrow-up"></i>
                            Check Out
                        </button>

                        <a :href="`booking_detail/${booking_detail.booking_id}`" class="btn btn-info btn-sm float-left">
                            <i class="fa fa-eye"></i>
                            View
                        </a>
                        <button v-if="booking_detail.status == 'checkout'" type="button" class="btn btn-danger btn-sm float-left" disabled>Delete Booking</button>
                        <button @click="deleteBooking(booking_detail.booking_id)" v-else type="button" class="btn btn-danger btn-sm float-left">
                            <i class="fa fa-trash"></i>
                            Delete Booking
                        </button>
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
                        <h1 class="m-0 text-dark">Calendar</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 

        <div class="demo-app-top">
            <button style="margin-left: 1.5%; margin-top: -3%" data-toggle="modal" data-target="#checkIn" class="btn btn-info btn-sm">Check in</button>
        </div>

        <FullCalendar
            style="margin-top:-5%;"
            class="demo-app-calendar"
            ref="fullCalendar"
            defaultView="dayGridWeek"
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
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from '@fullcalendar/list';

// must manually include stylesheets for each plugin
import "@fullcalendar/core/main.css";
import "@fullcalendar/daygrid/main.css";
import "@fullcalendar/timegrid/main.css";

export default {
    props: ['room_categories'],
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data: function() {
        return {
            data: [],
            selected: '',
            room_numbers: [],
            booking_details: [],
            booking_detail: {
                id: '',
                booking_id: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
                number_of_rooms: '',
                check_in: '',
                check_out: '',
                paid_status: '',
                nights: '',
                status: '',
                total: '',
            },
            cat_name: '',
            roomno: '',
            dates: {
                check_in: '',
                check_out: '',
                room_cat_id: ''
            },
            calendarPlugins: [
                dayGridPlugin,
                timeGridPlugin,
                interactionPlugin, // needed for dateClick
                listPlugin,
            ],
            calendarWeekends: true,
            calendarEvents: [],
            booking_payment: {
                booking_id: '',
                payment: '',
                amount_recieved: '',
            },
            charges: [],
            checkedPrices: [],
            checkedCharges: [],
            id: '',
            name: '',
            total: '',
            today_date: new Date().toJSON().slice(0,10).replace(/-/g,'/'),
            paid_status: '',
            edit: false,
            refer_id: ''
        };
    },

    created(){
        this.fetchData();
    },

    methods: {
        deleteBooking(id){
            swal({
                title: "Are you sure?",
                text: 'Confirm To "DELETE" this booking',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`/api/delete_booking/${id}`)
                    .then(res => {
                        this.calendarEvents = [];
                        this.fetchData();
                        swal("Confirmed", "Booking Reservation Deleted", "success");
                        $('#bookingDetail').fadeOut().modal('hide');
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
                            $('#bookingDetail').fadeOut().modal('hide');
                        }
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        // Compute Charges Selected
        computeTotalCharges(e){
            var checkedPricesTotal = 0;
            for(var i=0; i < this.checkedPrices.length; i++){
                checkedPricesTotal += this.checkedPrices[i]['charge_price']
                
            }

            for(var i=0; i < this.checkedCharges.length; i++){
                if(this.checkedCharges.length == 0){
                    console.log("empty");
                    if(this.checkedCharges[i]['id'] == e.id){
                        console.log("same")
                    }else{
                        this.checkedCharges.push ( 
                            e.id
                        )
                    }checkedCharges
                }else{
                    console.log("empty");
                }
                console.log("empty");
            }
            
            

            console.log(this.checkedCharges);
            this.total = this.total + checkedPricesTotal;
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
                        axios.post('/api/payment', [me.booking_payment, me.checkedCharges])
                        .then(res => {
                            this.booking_payment.payment = ''
                            this.calendarEvents = []
                            this.fetchData();
                            swal("Confirmed", "Payment Successful", "success");
                        })
                        .catch(err => {
                            swal("Oops", "Failed", "error");
                        })
                        $('#bookingDetail').fadeOut().modal('hide');

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
                    }

                }
            });
        },

        updateCurrentBooking(){
            swal({
                title: "Are you sure?",
                text: "Confirm To Update Booking",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put('/api/updateCurrentBooking', this.booking_detail)
                    .then(res => {
                        this.calendarEvents = []
                        this.fetchData();
                        $("#bookingDetail").modal('hide');
                        swal("Success", "Booking Updated", "success");
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        handleSelect(e){
            $("#bookingDetail").modal();
            this.refer_id = e.event._def.extendedProps.eventID
            axios.get('/api/booking_detail/'+this.refer_id)
            .then(res => {
                this.getCharges();

                this.booking_details = res.data.data;
                this.booking_detail.check_in = this.booking_details[0].check_in;
                this.booking_detail.check_out = this.booking_details[0].check_out;
                this.booking_detail.room_cat_id = this.booking_details[0].room_cat_id;
                this.booking_detail.room_no = this.booking_details[0].room_no;
                this.booking_detail.room_rate = this.booking_details[0].room_rate;
                this.booking_detail.total = this.booking_details[0].total;
                this.booking_detail.id = this.booking_details[0].id;
                this.booking_detail.booking_detail_id = this.refer_id;
                this.booking_detail.booking_id = this.booking_details[0].booking_id;
                this.cat_name = this.booking_details[0].category_name;
                this.booking_detail.paid_status = this.booking_details[0].paid_status;
                this.paid_status = this.booking_details[0].paid_status;
                this.booking_detail.status = this.booking_details[0].status;
                this.roomno = this.booking_details[0].room_no;

                this.id = this.booking_details[0].booking_id;
                this.name = this.booking_details[0].last_name + ', ' + this.booking_details[0].first_name;
                this.total = this.booking_details[0].grand_total;
            })
            .catch(err => {
                console.log(err)
            })
        },

        fetchData(){
            axios.get('/api/get_bookings')
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
                        color = 'brown';
                    }else if(this.data[i].status == 'reserved'){
                        color = '#d9534f';
                    }else if(this.data[i].status == 'checkout'){
                        color = '#5cb85c';
                    }else if(this.data[i].status == 'pending'){
                        color = '#f0ad4e';
                    }

                    if(this.data[i].room_no == 0){
                        room_no = '(Pending)';
                    }else{
                        room_no = this.data[i].room_no;
                    }
                  
                    this.calendarEvents.push(
                        {
                            color: color,
                            title: 'Room No - ' + room_no + ' ' + this.data[i].last_name + ', ' + this.data[i].first_name,
                            url: '#', 
                            start: new Date(this.data[i].check_in),
                            end: new Date(this.data[i].check_out),
                            eventID: this.data[i].id
                        }
                    )
                }
            })
            .catch(err => {
                console.log(err)
            })
        },

        getRoomNos(){
            // this.booking_detail.room_no = ''
            this.dates.check_in = this.booking_detail.check_in;
            this.dates.check_out = this.booking_detail.check_out;
            this.dates.room_cat_id = this.booking_detail.room_cat_id;

            var date1 = new Date(this.booking_detail.check_in);
            var date2 = new Date(this.booking_detail.check_out);
            var timeDiff = date1.getTime() - date2.getTime();
            var dateDiff = timeDiff / (1000 * 3600 * 24); 
            var finalDiff = dateDiff * -1;
            axios.post('/api/available_rooms', this.dates )
            .then(res => {
                if(res.data.data == ''){
                    this.roomno = 'Choose Room No.'
                    this.booking_detail.room_rate = '';
                    this.booking_detail.total = '';
                    this.room_numbers = res.data.data;
                }else{
                    this.roomno = 'Choose Room No.'
                    this.booking_detail.room_rate = res.data.data[0].room_rate
                    this.booking_detail.total = res.data.data[0].room_rate * finalDiff;
                    this.room_numbers = res.data.data;
                }
            });
        },

        clearRoomNo(){
            this.booking_detail.room_no = ''
        },

        dispatch (e) {
            this.$emit('input', e)
            this.selected = e
        },
    }
};
</script>

<style>
    .with-border {
        border: 1px solid black;
        /* max-height: 20px; */
    }

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

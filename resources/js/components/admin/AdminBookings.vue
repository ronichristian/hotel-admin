<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <!-- BOOKING DETAILS -->
            <div class="modal modal fade bd-example-modal-xl" id="bookingDetail" tabindex="-1" role="dialog" aria-hidden="true">
                <div style="max-width: 100%;" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
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
            <!-- DETAILs -->
            <div class="modal modal fade bd-example-modal-xl" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
                <div style="max-width: 80%;" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> AdminLTE, Inc.
                                        <small class="float-right">Date: 2/10/2014</small>
                                    </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Admin, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (804) 123-5432<br>
                                        Email: info@almasaeedstudio.com
                                    </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>John Doe</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (555) 539-1037<br>
                                        Email: john.doe@example.com
                                    </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Payment Due:</b> 2/22/2014<br>
                                    <b>Account:</b> 968-34567
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                    
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Amount Due 2/22/2014</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>$250.30</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax (9.3%)</th>
                                                        <td>$10.34</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping:</th>
                                                        <td>$5.80</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>$265.24</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Button trigger modal -->
<!--         
        <a class="btn btn-info btn-sm float-left"  :href="'/admin_rooms_status'">
            Rooms Status
        </a> -->
        <div class="panel-body">
            <div class="table-responsive">
                <div class="tableFilters">
                    <input class="form-control float-left col-9" type="text" v-model="tableData.search" placeholder="Search" @input="fetchAdminBookings()">
                    <div class="select">
                        <select class="form-control float-right col-1" v-model="tableData.length" @change="fetchAdminBookings()">
                            <option value="10" selected="selected">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>   
                    </div>
                </div>
                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy" >
                    <tbody>
                        <tr v-for="booking in bookings" v-bind:key="booking.id" >
                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">{{ booking.id }}</td>
                            <td v-else align="center">{{ booking.id }}</td>

                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">{{ booking.last_name }}, {{ booking.first_name }} {{ booking.mi }}.</td>
                            <td v-else align="center">{{ booking.last_name }}, {{ booking.first_name }} {{ booking.mi }}.</td>

                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">{{ booking.email_address }}</td>
                            <td v-else align="center">{{ booking.email_address }}</td>

                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">{{ booking.grand_total }}</td>
                            <td v-else align="center">{{ booking.grand_total }}</td>

                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">{{ booking.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                            <td v-else align="center">{{ booking.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                            
                            <td v-if="booking.viewed_status == 0" style="background-color:#3c8dbc; color:white;" align="center">
                                 <button @click="fetchAdminBookingsDetails(booking.id)" data-toggle="modal" data-target="#bookingDetail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button @click="fetchAdminBookingsDetails(booking.id)" data-toggle="modal" data-target="#detail" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                </button>
                                <a :href="`booking_detail/${booking.id}`" class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </td>
                            <td v-else align="center">
                                 <button @click="fetchAdminBookingsDetails(booking.id)" data-toggle="modal" data-target="#bookingDetail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button @click="fetchAdminBookingsDetails(booking.id)" data-toggle="modal" data-target="#detail" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                </button>
                                <a :href="`booking_detail/${booking.id}`" class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </datatable>
                <pagination :pagination="pagination" 
                    @prev="fetchAdminBookings(pagination.prevPageUrl)"
                    @next="fetchAdminBookings(pagination.nextPageUrl)">
                </pagination>
            </div>
        </div>
    </div>
</template>

<script>
import Datatable from '.././Datatable.vue';
import Pagination from '.././Pagination';

export default {
    components: { datatable: Datatable, pagination: Pagination },
    data(){
        let sortOrders = {};
        let columns = [
            {label: 'Booking No.', name: 'id'},
            {label: 'Guest Name', name: 'name'},
            {label: 'Email', email_address: 'email_address'},
            {label: 'Payment', name: 'grand_total'},
            {label: 'Date', name: 'created_at'},
            {label: 'Details', name: 'details'},
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });

        return {
            bookings: [],
            booking_details: [],
            dates: [],
            category_name: '',

            // -------------

            columns: columns,
            sortKey: 'created_at',
            sortOrders: sortOrders,
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: '',
            },
        }
    },

    created(){
        this.fetchAdminBookings();
    },

    methods: {
        fetchAdminBookings(url = '/api/admin_bookings'){
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
            .then(res => {
                let data = res.data;
                if(this.tableData.draw == data.draw){
                    this.bookings = data.data.data;
                    this.configPagination(data.data);
                }
            })
            .catch(errors => {
                console.log(errors);
            });
        },

        fetchAdminBookingsDetails(id){
            axios.get('/api/admin_bookings_details/'+id)
            .then(res => {
                this.booking_details = res.data.data;
            })
            .catch(err => {
                console.log(err)
            })
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

        sortBy(key){
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.fetchAdminBookings();
        },

        getIndex(array, key, value){
            return array.findIndex(i => i[key] == value);
        }
    }
}
</script>
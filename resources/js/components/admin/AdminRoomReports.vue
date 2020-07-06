<template>
<div class="panel panel-default">

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Month Room Report</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Specific Room</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="activity">
                        <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <span>Select Date:</span>
                        <vue-monthly-picker 
                            v-model="selectedMonth"
                            :monthLabels=monthLabels
                            @selected="onSelected"
                            style="width: 10px;"
                        >
                        </vue-monthly-picker>
                        <!-- <div style="position: relative; z-index: 99999; margin-top:-6%; margin-left:20%;">
                            <small style="font-size: 15px; font-weight:600;">
                                Select Date
                            </small>
                            <month-picker-input style="" :no-default="true"></month-picker-input>
                        </div> -->
                        <div class="invoice p-3 mb-3">
                                <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>    
                                    <i class="fas fa-globe"></i> UFLS Homestay
                                        <small class="float-right">
                                            Date: {{date}}
                                        </small>
                                    </h4>
                                </div>
                            <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                    <strong>UFLS</strong><br>
                                    Musuan, Maramag, Bukidnon<br>
                                    Phone: 	0905-775-8521<br>
                                    Email: hsfeo@cmu.edu.ph
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                    <strong>John Doe</strong><br>
                                    Remiter<br>
                                    Phone: (555) 539-1037<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Detail</th>
                                                <th>Booking No.</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="room_report in room_reports" v-bind:key="room_report.id">
                                                <td align="">{{ room_report.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                                                <td align="">{{ room_report.last_name }}, {{ room_report.first_name }}</td>
                                                <td align="">{{ room_report.id }}</td>
                                                <td align="">{{ room_report.payment | currency }}</td>
                                                <td align="">{{ room_report.payment | currency }}</td>
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
                                    <p class="lead">Amount Due {{date}}</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Revenue:</th>
                                                    <td style="color:red; font-weight: 600;">{{total | currency}}</td>
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
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="settings">
                    <div class="tab-pane" id="timeline">
                        <span>Select Date:</span>
                        <vue-monthly-picker 
                            v-model="selectedMonth"
                            :monthLabels=monthLabels
                            @selected="onSelected"
                            style="width: 10px;"
                        >
                        </vue-monthly-picker>
                        <!-- <div style="position: relative; z-index: 99999; margin-top:-6%; margin-left:20%;">
                            <small style="font-size: 15px; font-weight:600;">
                                Select Date
                            </small>
                            <month-picker-input style="" :no-default="true"></month-picker-input>
                        </div> -->
                        <div class="invoice p-3 mb-3">
                                <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>    
                                    <i class="fas fa-globe"></i> UFLS Homestay
                                        <small class="float-right">
                                            Date: {{date}}
                                        </small>
                                    </h4>
                                </div>
                            <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                    <strong>UFLS</strong><br>
                                    Musuan, Maramag, Bukidnon<br>
                                    Phone: 	0905-775-8521<br>
                                    Email: hsfeo@cmu.edu.ph
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                    <strong>John Doe</strong><br>
                                    Remiter<br>
                                    Phone: (555) 539-1037<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Room Name</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="specific_room_report in specific_room_reports" v-bind:key="specific_room_report.id">
                                                <td align="">{{ specific_room_report.category_name }}</td>
                                                <td align="">{{ specific_room_report.total_cost | currency }}</td>
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
                                    <p class="lead">Amount Due {{date}}</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Revenue:</th>
                                                    <td>{{ total | currency }}</td>
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
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import Vue from 'vue'
import { MonthPicker } from 'vue-month-picker'
import { MonthPickerInput } from 'vue-month-picker'
import VueMonthlyPicker from 'vue-monthly-picker'

export default {
    components: {
        MonthPicker,
        MonthPickerInput,
        VueMonthlyPicker
    },

    data(){
        return {
            date: '',
            room_reports: [],
            specific_room_reports: [],
            total: 0,
            selectedMonth: '',
            monthLabels: [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
            ]
        }
    },
    
    created(){
        this.getRoomReports();
        this.getSpecificRoomReports();
    },

    methods:{
        getRoomReports(){
            var d1 = new Date(),
            month1 = '' + (d1.getMonth() + 1),
            day1 = '' + d1.getDate(),
            year1 = d1.getFullYear();

            var currentDate = [day1, month1, year1].join('/')
            this.date = currentDate;

            var dyanamicCurrentDate = [month1, month1, year1].join('/')
            this.selectedMonth = dyanamicCurrentDate;

            axios.get('/api/room_reports')
            .then(res => {
                this.room_reports = res.data[0];
                this.total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        },

        getSpecificRoomReports(){
             axios.get('/api/specific_room_reports')
            .then(res => {
                this.specific_room_reports = res.data[0];
                this.total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        },

        onSelected(){
            var date = new Date(this.selectedMonth);
            var monthNumber = date.getMonth() + 1;

            axios.get('/api/month_room_report/'+monthNumber)
            .then(res => {
                this.room_reports = res.data[0];
                this.total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
<template>
<div class="panel panel-default">

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Cash Month Report</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">TOF Month Report</a></li>
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
                                    Payment Method: <b>Cash</b><br>
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
                                                <th>Venue</th>
                                                <th>Event</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="bangquet_report in cash_bangquet_reports" v-bind:key="bangquet_report.id">
                                                <td align="">{{ bangquet_report.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                                                <td align="">{{ bangquet_report.service_name }}</td>
                                                <td align="">{{ bangquet_report.event_name }}</td>
                                                <td align="center">{{ bangquet_report.balance | currency }}</td>
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
                                                    <td style="color:red; font-weight: 600;">{{this.cash_report_total | currency}}</td>
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
                                    Payment Method: <b>Transfer of Funds</b><br>
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
                                                <th>Venue</th>
                                                <th>Event</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="bangquet_report in tof_bangquet_reports" v-bind:key="bangquet_report.id">
                                                <td align="">{{ bangquet_report.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                                                <td align="">{{ bangquet_report.service_name }}</td>
                                                <td align="">{{ bangquet_report.event_name }}</td>
                                                <td align="center">{{ bangquet_report.balance | currency }}</td>
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
                                                    <td>{{ tof_report_total | currency }}</td>
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
            cash_bangquet_reports: [],
            tof_bangquet_reports: [],
            cash_report_total: 0,
            tof_report_total: 0,
            selectedMonth: '',
            monthLabels: [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
            ]
        }
    },
    
    created(){
        this.getBangquetRoomReports();
        this.getTOFBanguqetReports();
    },

    methods:{
        getBangquetRoomReports(){
            var d1 = new Date(),
            month1 = '' + (d1.getMonth() + 1),
            day1 = '' + d1.getDate(),
            year1 = d1.getFullYear();

            var currentDate = [day1, month1, year1].join('/')
            this.date = currentDate;

            var dyanamicCurrentDate = [month1, month1, year1].join('/')
            this.selectedMonth = dyanamicCurrentDate;

            axios.get('/api/cash_bangquet_reports')
            .then(res => {
                this.cash_bangquet_reports = res.data[0];
                this.cash_report_total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        },

        getTOFBanguqetReports(){
             axios.get('/api/tof_bangquet_reports')
            .then(res => {
                this.tof_bangquet_reports = res.data[0];
                this.tof_report_total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        },

        onSelected(){
            var date = new Date(this.selectedMonth);
            var monthNumber = date.getMonth() + 1;

            axios.get('/api/cash_month_bangquet_report/'+monthNumber)
            .then(res => {
                this.cash_bangquet_reports = res.data[0];
                this.cash_report_total = res.data.total[0]['remit']
            })
            .catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
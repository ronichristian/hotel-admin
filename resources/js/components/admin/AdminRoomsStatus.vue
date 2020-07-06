<template>
     <div class="panel panel-default">
        <div class="panel-heading">
            <a class="btn btn-info btn-sm float-right"  :href="'/admin_bookings'">
                Go Back
            </a>


        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <div class="tableFilters">
                    <div class="select" style="width: 7%;">
                        <select class="form-control " v-model="tableData.length" @change="roomStatus()">
                            <option value="5" selected="selected">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>   
                    </div>
                    <div style="width: 50%;" class="col-12 md-12">
                        <label>Enter dates to check Available Rooms</label>
                        <datepicker
                            v-model="tableData.check_in_date"
                            :disabledDates="disabledDates"
                            :format="DatePickerFormat"
                            @input="roomStatus()"
                            placeholder="Check In Date" >
                        </datepicker>
                        <datepicker
                            v-model="tableData.check_out_date"
                            :format="DatePickerFormat"
                            :disabledDates="disabledDates" 
                            @input="roomStatus()" 
                            placeholder="Check Out Date" >
                        </datepicker>
                    </div>
                </div>
                <h2>Dates: 
                    <span class="text-success">
                        {{ tableData.check_in_date | moment("dddd, MMMM Do YYYY") }} to {{ tableData.check_out_date | moment("dddd, MMMM Do YYYY") }} 
                    </span>
                </h2>
                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy" >
                    <tbody>
                        <tr v-for="room in rooms" v-bind:key="room.id" class="odd gradeX">
                            <td>{{ room.room_no }}</td>
                            <td>{{ room.category_name }}</td>
                        </tr>
                    </tbody>
                </datatable>
                <pagination :pagination="pagination" 
                    @prev="roomStatus(pagination.prevPageUrl)"
                    @next="roomStatus(pagination.nextPageUrl)">
                </pagination>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import Datatable from '.././Datatable.vue';
import Pagination from '.././Pagination';

export default {
    components: { datatable: Datatable, pagination: Pagination, Datepicker },
    data(){
        let sortOrders = {};
        let columns = [
            {label: 'Room No', name: 'room_no'},
            {label: 'Room Type', name: 'category_name'},
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });

        return {
            rooms: [],
            room: {
                id: '',
                room_no: '',
                room_cat_id: '',
            },
            room_categories: [],
            room_cat: {
                id: '',
                category_name: '',
                room_rate: '',
                description: '',
            },
            category_name: '',
            edit: false,
            DatePickerFormat: "dd/MM/yyyy",
            disabledDates: {
                to: new Date(Date.now() - 8640000)
            },

            // -------------

            columns: columns,
            sortKey: 'created_at',
            sortOrders: sortOrders,
            tableData: {
                draw: 0,
                length: 5,
                check_in_date: '',
                check_out_date: '',
                column: 0,
                dir: 'asc',
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
        this.roomStatus();
    },

    methods: {
        roomStatus(url = 'api/room_status'){
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(res => {
                    let data = res.data;
                    if(this.tableData.draw == data.draw){
                        this.rooms = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
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

        sortBy(key){
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.roomStatus();
        },

        getIndex(array, key, value){
            return array.findIndex(i => i[key] == value);
        }

    }
}
</script>
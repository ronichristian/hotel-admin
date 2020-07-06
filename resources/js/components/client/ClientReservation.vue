<template>
    <div class="container">
        <div class="row mb-5 pt-5 justify-content-center">
            <div class="col-md-7 text-center section-heading">
            <h2 class="heading">Reservation</h2>
            </div>
        </div>

        <div style="margin-top: -5%;"  class="row">
            <div class="tableFilters">
                <div class="select float-left">
                    <select class="form-control col-12" v-model="tableData.length" @change="fetchBookingDetail()">
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>   
                </div>
                <input class="form-control" type="text" v-model="tableData.search" placeholder="Search Booking No. ..." @input="fetchBookingDetail()">
            </div>
            <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy" >
                <tbody>
                    <tr v-for="booking in bookings" v-bind:key="booking.id">
                        <td align="center">{{ booking.id }}</td>
                        <td align="center">{{ booking.number_of_rooms }}</td>
                        <td align="center">{{ booking.grand_total }}</td>
                        <td align="left">{{ booking.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                        <td align="center">
                            <a :href="'/reservation_detail/'+booking.id" class="btn btn-primary float-right">Details</a>
                        </td>
                    </tr>
                </tbody>
            </datatable>
            <pagination :pagination="pagination" 
                @prev="fetchBookingDetail(pagination.prevPageUrl)"
                @next="fetchBookingDetail(pagination.nextPageUrl)">
            </pagination>
        </div>
    </div>
</template>

<script>
import Datatable from '.././Datatable.vue';
import Pagination from '.././Pagination';

export default {
    components: { datatable: Datatable, pagination: Pagination },
    data() {
        let sortOrders = {};
        let columns = [
            {label: 'Booking No.', name: 'id'},
            {label: 'No. Of Rooms', name: 'number_of_rooms'},
            {label: 'Payment', name: 'grand_total'},
            {label: 'Date', name: 'created_at'},
            {label: 'Details', name: 'details'},
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });

        return {
            bookings: [],
            user: {
                id: '',
                name: '',
            },

            // -------------

            columns: columns,
            sortKey: 'id',
            sortOrders: sortOrders,
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
                user_id: Vue.prototype.$userId,
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

    mounted(){
        this.fetchBookingDetail(); 
        this.user.id = Vue.prototype.$userId;
    },

    methods: {
        fetchBookingDetail(url = `api/bookings`){
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
            this.fetchBookingDetail();
        },

        getIndex(array, key, value){
            return array.findIndex(i => i[key] == value);
        }
    }
}
</script>
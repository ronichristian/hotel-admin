<template>
     <div class="panel panel-default">
        <div class="panel-heading">
            <!-- ADD ROOM TYPE -->
            <div class="modal fade" id="addRoomType" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Room Type</h5>
                        <button @click="clear()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="addRoomType">
                                <div class="form-group">
                                    <label >Room Name</label>
                                    <input v-model="room_cat.category_name" type="text" name="category_name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label >Room Rate</label>
                                    <input v-model="room_cat.room_rate" type="number" name="room_rate" step="0.01" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Facilities</label>
                                    <textarea v-model="room_cat.facilities" class="form-control" name="facilities"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Persons</label>
                                    <textarea v-model="room_cat.persons" class="form-control" name="persons"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click="clear()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADD ROOMS -->
            <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 style="font-size: 30px;" class="modal-title" id="exampleModalLabel">Room Type: <span style="color: green;"> {{ category_name }} </span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="addRoomNumber">
                                <div class="form-group">
                                    <label >Add Room</label>
                                    <input v-model="room.room_no" type="text" name="category_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Room No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="room in rooms" v-bind:key="room.id">
                                        <td>{{ room.room_no }}</td>
                                        <td>
                                            <button @click="deleteRoomNumber(room.id)" class="btn btn-danger btn-sm">
                                                <i class="fa fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addRoomType">
            Add Room Type
        </button>

        <!-- <a class="btn btn-info btn-sm"  :href="'/admin_rooms_status'">
            Rooms Status
        </a> -->
            
        <div class="panel-body">
            <div class="table-responsive">
                <div class="tableFilters">
                    <input class="form-control float-left col-9" type="text" v-model="tableData.search" placeholder="Search" @input="fetchroom_categories()">
                    <div class="select">
                        <select class="form-control float-right col-1" v-model="tableData.length" @change="fetchroom_categories()">
                            <option value="10" selected="selected">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>   
                    </div>
                </div>
                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy" >
                    <tbody>
                        <tr v-for="room_cat in room_categories" v-bind:key="room_cat.id" class="odd gradeX">
                            <td align="">{{ room_cat.category_name }} </td>
                            <td align="right">{{ room_cat.room_rate }}</td>
                            <td align="">{{ room_cat.facilities }}</td>
                            <td align="center">{{ room_cat.persons }}</td>
                            <td v-if="room_cat.count_room == 0" align="center">None</td>
                            <td v-else align="center">{{ room_cat.count_room }}</td>
                            <td>
                                <button @click="editRoom(room_cat)" data-toggle="modal" data-target="#addRoomType" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button @click="addRoomModal(room_cat)" data-toggle="modal" data-target="#addRoom" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button @click="deleteRoom(room_cat.id)" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </datatable>
                <pagination :pagination="pagination" 
                    @prev="fetchProducts(pagination.prevPageUrl)"
                    @next="fetchProducts(pagination.nextPageUrl)">
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
            {label: 'Room Name', name: 'category_name'},
            {label: 'Room Rate', name: 'room_rate'},
            {label: 'Facilities', name: 'facilities'},
            {label: 'Capacity', name: 'persons'},
            {label: 'Rooms', name: 'count_room'},
            {label: 'Action', name: 'action'},
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
                facilities: '',
                persons: '',
            },
            category_name: '',
            edit: false,

            // -------------

            columns: columns,
            sortKey: 'room_rate',
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
        this.fetchroom_categories();
    },

    methods: {
        fetchroom_categories(url = 'api/display_room_types'){
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
            .then(res => {
                let data = res.data;
                if(this.tableData.draw == data.draw){
                    this.room_categories = data.data.data;
                    this.configPagination(data.data);
                }
            })
            .catch(errors => {
                console.log(errors);
            });
        },

        // Add Room Type
        addRoomType(){
            if(this.edit === false)
            {
                axios.post('/api/room', this.room_cat)
                .then(res => {
                    this.room_cat.category_name = '';
                    this.room_cat.room_rate = '';
                    this.room_cat.facilities = '';
                    this.room_cat.persons = '';
                    this.fetchroom_categories();
                    toastr.success("Success", "Room Added", "success");
                })
                .catch(err => {
                    swal("Oops", "Something went wrong", "error");
                })
            }
            else
            {
                this.edit === false;
                axios.put('/api/room', this.room_cat)
                .then(res => {
                    this.room_cat.category_name = '';
                    this.room_cat.room_rate = '';
                    this.room_cat.facilities = '';
                    this.room_cat.persons = '';
                    this.fetchroom_categories();
                    toastr.success("Success", "Room Updated", "success");
                })
                .catch(err => {
                    swal("Oops", "Something went wrong", "error");
                })
            }
        },
        
        // Delete Room Type
        deleteRoom(id){
            swal({
                title: "Are you sure?",
                text: "Confirm to Delete Room",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`/api/room/${id}`)
                    .then(data => {
                        toastr.info("Done!", "Room Deleted", "success");
                        this.fetchroom_categories();
                    })
                }
            });
        },

        editRoom(room){
            this.edit = true;
            this.room_cat.id = room.id;
            this.room_cat.category_name = room.category_name;
            this.room_cat.room_rate = room.room_rate;
            this.room_cat.facilities = room.facilities;
            this.room_cat.persons = room.persons;
        },

        clear(){
            this.room_cat.id = '';
            this.room_cat.category_name = '';
            this.room_cat.room_rate = '',
            this.room_cat.facilities = '';
            this.room_cat.persons = '';
            this.edit = false;
        },

        // Add Room MODAL
        addRoomModal(room){ 
            axios.get(`/api/get_rooms/${room.id}`)
            .then(res => {
                this.rooms = res.data.data
            })
            this.category_name = room.category_name;
            this.room.room_cat_id = room.id
        },

        // Add Room Number
        addRoomNumber(){
            if(this.edit === false)
            {
                axios.post('/api/add_room_number', this.room)
                .then(data => {
                    axios.get(`api/get_rooms/${this.room.room_cat_id}`)
                    .then(res => {
                        this.rooms = res.data.data
                        toastr.success("Success", "Room Added", "success");
                    })
                    this.room.room_no = '';
                })
                .catch(errors => {
                    toastr.error("Error", "Room number already exist", "error");
                });
            }
            else
            {

            }
        },

        // Delete Room Number
        deleteRoomNumber(id){
            swal({
                title: "Are you sure?",
                text: "Confirm to Delete Room Number",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`/api/delete_room_number/${id}`)
                    .then(res => {
                        axios.get(`/api/get_rooms/${this.room.room_cat_id}`)
                        .then(res => {
                            this.rooms = res.data.data
                        })
                        toastr.info("Done!", "Room Number Deleted", "success");
                    })
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

        sortBy(key){
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.fetchroom_categories();
        },

        getIndex(array, key, value){
            return array.findIndex(i => i[key] == value);
        }

    }
}
</script>
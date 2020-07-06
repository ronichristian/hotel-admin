<template>
     <div class="panel panel-default">
         <!-- Add/Edit Service Modal  -->
        <div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Servvice Type</h5>
                    <!-- <button @click="clear()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addService">
                            <div class="form-group">
                                <label>Service Name</label>
                                <input v-model="service.service_name" type="text" name="service_name" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Rentable</label>
                                <input v-model="service.rentable" 
                                    type="checkbox" 
                                    name="rentable" 
                                    class="form-control"
                                    style="margin-left: -45%;"
                                    >
                                <label>Rent Fee</label>
                            </div>
                            
                            <div class="form-group">
                                <label>Rent Fee</label>
                                <input v-model="service.rent_fee" type="number" name="rent_fee" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- <button @click="clear()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

         <!-- Add/Edit Charge Modal  -->
        <div class="modal fade" id="addCharge" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Charge Type</h5>
                    <!-- <button @click="clear()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addCharge">
                            <div class="form-group">
                                <label >Charge</label>
                                <input v-model="charge.charge_name" type="text" name="charge_name" class="form-control" >
                                <label >Price</label>
                                <input v-model="charge.charge_price" type="number" name="charge_price" class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- <button @click="clear()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Facilities & Aminities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Other Charges</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addService">
                            Add Service Type
                        </button>
                        <hr>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <div class="tableFilters">
                                            <input class="form-control float-left col-9" type="text" v-model="tableData.search" placeholder="Search" @input="getServices()">
                                            <div class="select">
                                                <select class="form-control float-right col-1" v-model="tableData.length" @change="getServices()">
                                                    <option value="10" selected="selected">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                </select>   
                                            </div>
                                        </div>
                                        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy" >
                                            <tbody>
                                                <tr v-for="service in services" v-bind:key="service.id" class="odd gradeX">
                                                    <td align="">{{ service.service_name }} </td>

                                                    <td v-if="service.rentable == 0" align="center">
                                                        <span class="badge badge-info">Not Rentable</span>
                                                    </td>
                                                    <td v-if="service.rentable == 1" align="center">
                                                        <span class="badge badge-success">Rentable</span>
                                                    </td>

                                                    <td align="right">{{ service.rent_fee }} </td>
                                                    <td>
                                                        <button @click="editService(service)" data-toggle="modal" data-target="#addService" class="btn btn-info btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="deleteService(service.id)" class="btn btn-danger btn-sm">
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
                        </div>
                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addCharge">
                            Add Charge Type
                        </button>
                        <hr>
                        <table style="white-space: nowrap;" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr style="white-space: nowrap;">
                                    <th align="right">Charge Name</th>
                                    <th align="right">Charge Price</th>
                                    <th align="right">Action</th>
                                </tr>
                            </thead>
                            <tbody style="white-space: nowrap;">
                                <tr v-for="charge in charges" v-bind:key="charge.id" class="odd gradeX">
                                    <td>{{ charge.charge_name }} </td>
                                    <td>{{ charge.charge_price }} </td>
                                    <td>
                                        <button @click="editCharge(charge)" data-toggle="modal" data-target="#addCharge" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button @click="deleteCharge(charge.id)" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
import Datatable from '.././Datatable.vue';
import Pagination from '.././Pagination';

export default {
    components: { datatable: Datatable, pagination: Pagination },
    data(){
        let sortOrders = {};
        let columns = [
            {label: 'Service', name: 'service_name'},
            {label: 'Status', name: 'rentable'},
            {label: 'Rent Fee', name: 'rent_fee'},
            {label: 'Action', name: 'action'},
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });

        return {
            services: [],
            service: {
                id: '',
                service_name: '',
                rentable: '',
                rent_fee: '',
            },
            charges: [],
            charge: {
                id: '',
                charge_name: '',
                charge_price: ''
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
        this.getServices();
        this.getCharges();
    },

    methods: {
        // Add Service
        addService(){
            if(this.edit === false)
            {
                this.services.service_name = '';
                this.services.rentable = '';
                this.services.rent_fee = '';
                fetch('api/service', {
                    method: 'post',
                    body: JSON.stringify(this.service),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.service.service_name = '';
                    this.getServices();
                    toastr.success("Success", "Room Added", "success");
                })
            }
            else if(this.edit === true)
            {
                fetch('api/service',{
                    method: 'put',
                    body: JSON.stringify(this.service),
                    headers:{
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.edit = false;
                    this.service.service_name = '';
                    this.getServices();
                    toastr.success("Done!", "Room Updated", "success");
                    $('#addService').fadeOut().modal('hide');
                })
            }
        },

        //Edit Service
        editService(service){
            this.edit = true;
            this.service.id = service.id;
            this.service.service_name = service.service_name;
            this.service.rentable = service.rentable;
            this.service.rent_fee = service.rent_fee;
        },

        // Delete Room Type
        deleteService(id){
            swal({
                title: "Are you sure?",
                text: "Confirm to Delete Service Type",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    fetch(`api/service/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.info("Done!", "Service Deleted", "success");
                        this.getServices();
                    })
                }
            });
        },

        // Add Charge
        addCharge(){
            if(this.edit === false)
            {
                fetch('api/charge', {
                    method: 'post',
                    body: JSON.stringify(this.charge),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.charge.charge_name = '';
                    this.charge.charge_price = '';
                    this.getCharges();
                    toastr.success("Success", "Room Added", "success");
                })
            }
            else
            {
                fetch('api/charge',{
                    method: 'put',
                    body: JSON.stringify(this.charge),
                    headers:{
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.edit = false;
                    this.charge.charge_name = '';
                    this.charge.charge_price = '';
                    this.getCharges();
                    toastr.success("Done!", "Room Updated", "success");
                    $('#addCharge').fadeOut().modal('hide');
                })
            }
        },

        // Edit Charge
        editCharge(charge){
            this.edit = true;
            this.charge.id = charge.id;
            this.charge.charge_name = charge.charge_name;
            this.charge.charge_price = charge.charge_price;
        },

        deleteCharge(id){
            swal({
                title: "Are you sure?",
                text: "Confirm to Delete Charge Type",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    fetch(`api/charge/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.info("Done!", "Charge Type Deleted", "success");
                        this.getCharges();
                    })
                }
            });
        },
        
        // Fetch Charges
        getCharges(){
            axios.get('api/get_other_charges')
            .then(res => {
                this.charges = res.data.data;
            })
            .catch(err => {
                console.log(err)
            })
        },

        // Fetch Services
        getServices(url = 'api/display_services'){
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(res => {
                    let data = res.data;
                    if(this.tableData.draw == data.draw){
                        this.services = data.data.data;
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
            this.fetchroom_categories();
        },

        getIndex(array, key, value){
            return array.findIndex(i => i[key] == value);
        }

    }
}
</script>
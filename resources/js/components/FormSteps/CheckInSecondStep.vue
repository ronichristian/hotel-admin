<template>
    <el-form :model="model" :rules="rules" ref="form">
        <div class="row">

            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Check In" prop="check_in">
                    <el-date-picker min="2020-04-12" v-model="model.check_in" type="date" name="check_in" ></el-date-picker>
                </el-form-item>
            </div>

            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Check Out" prop="check_out">
                    <el-date-picker v-model="model.check_out" type="date" name="check_out" ></el-date-picker>
                </el-form-item>
            </div>

            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                <el-form-item label="Room Category" prop="room_cat_id">
                    <el-select
                        v-model="model.room_cat_id"
                        :value="selected"
                        @input="dispatch"
                        @change="calculate()"
                        placeholder="Filter by short name"
                        style="color:green">
                        <el-option
                            v-for="room_cat in this.room_categories"
                            :key="room_cat.id"
                            :label="room_cat.category_name"
                            :value="room_cat.id"
                            style="color:green">
                        </el-option>
                    </el-select>
                </el-form-item>
            </div>

            <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                <el-form-item label="Room Number" prop="room_no">
                    <el-select
                        v-model="model.room_no"
                        :value="selected"
                        @input="dispatch"
                        @change="calculate()"
                        placeholder="Filter by short name"
                        style="color:green">
                        <el-option
                            v-for="roomno in this.room_numbers"
                            :key="roomno.room_no"
                            :label="roomno.room_no"
                            :value="roomno.room_no"
                            style="color:green">
                        </el-option>
                    </el-select>
                </el-form-item>
            </div>


    
            <!-- <div class="col-md-2 mb-2 mb-lg-2 col-lg-2">
                <el-form-item label="Number of Rooms" prop="number_of_rooms">
                    <el-input placeholder="No. of rooms" @change="calculate()" v-model="model.number_of_rooms" name="number_of_rooms" type="number" ></el-input>
                </el-form-item>
            </div> -->

            <div class="col-md-5 mb-4 mb-lg-4 col-lg-5">
                <el-form-item label="Room Rate" prop="room_rate" style="color:red">
                    <el-input style="color:red" placeholder="No. of rooms" v-model="model.room_rate" name="room_rate" type="number" ></el-input>
                </el-form-item>
            </div>

            <div class="col-md-5 mb-4 mb-lg-4 col-lg-5">
                <el-form-item label="Total" prop="room_rate" style="color:red">
                    <el-input style="color:red" placeholder="No. of rooms" v-model="total" name="total" type="number" ></el-input>
                </el-form-item>
            </div>

        </div>
    </el-form>
    

</template>

<script>
export default {
    props: ['room_categories', 'booking'],
    data(){
        return {
            disabledDates: {
                from: new Date(Date.now())
            },
            selected: '',
            rooms: [],
            room_numbers: [],
            dates: {
                check_in: '',
                check_out: '',
                room_cat_id: ''
            },
            model: {
                
                check_in: '',
                check_out: '',
                number_of_rooms: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
            },
            total: '',
            rules: {
                check_in: [{
                    required: true,
                    message: 'Check in date is required',
                    trigger: 'blur'
                }],
                check_out: [{
                    required: true,
                    message: 'Check out date is required',
                    trigger: 'blur'
                }],
                room_no: [{
                    required: true,
                    message: 'Room Number is required',
                    trigger: 'blur'
                }],
                number_of_rooms: [{
                    required: true,
                    message: 'Number of rooms is required',
                    trigger: 'blur'
                }],
                room_rate: [{
                    required: true,
                    message: 'Number of rooms is required',
                    trigger: 'blur'
                }],
                room_categories: [{
                    required: true,
                    message: 'Number of rooms is required',
                    trigger: 'blur'
                }]
            },
        }
    },
    mounted(){
        this.model.check_in = this.date_start;
        this.model.check_out = this.date_end;
        this.model.number_of_rooms = 1;
    },
    methods: {
        validate() {
            return new Promise((resolve, reject) => {
                this.$refs.form.validate((valid) => {
                this.$emit('on-validate', valid, this.model)
                    resolve(valid);
                });
            })
        },
       
        dispatch (e) {
            this.$emit('input', e)
            this.selected = e
        },

        calculate(){
            var date1 = new Date(this.model.check_in);
            var date2 = new Date(this.model.check_out);
            var timeDiff = date1.getTime() - date2.getTime();
            var dateDiff = timeDiff / (1000 * 3600 * 24); 
            var finalDiff = dateDiff * -1;

            axios.get(`/api/calculate/${this.model.room_cat_id}`)
            .then(res => {
                this.rooms = res.data.rooms;
                this.model.room_rate = res.data.room_rate;
                this.total = (this.model.number_of_rooms * res.data.room_rate) * finalDiff;
            })

            var d1 = new Date(date1),
            month1 = '' + (d1.getMonth() + 1),
            day1 = '' + d1.getDate(),
            year1 = d1.getFullYear();

            var d2 = new Date(date2),
            month2 = '' + (d2.getMonth() + 1),
            day2 = '' + d2.getDate(),
            year2 = d2.getFullYear();

            var checkInDate = [year1, month1, day1].join('-')
            var checkOutDate = [year2, month2, day2].join('-')

            this.dates.check_in = checkInDate;
            this.dates.check_out = checkOutDate;
            this.dates.room_cat_id = this.model.room_cat_id;

            this.model.check_in = checkInDate;
            this.model.check_out = checkOutDate;

            var me = this;

            axios.post('/api/available_rooms', me.dates )
            .then(res => {
                this.room_numbers = res.data.data;
            });

        }
    }
}
</script>



<template>
    <el-form :model="model" :rules="rules" ref="form">
        <div class="row">
            <div class="col-md-5 mb-2 mb-lg-2 col-lg-5">
                <el-form-item label="Last name" prop="last_name">
                    <el-input placeholder="Last Name" v-model="model.last_name" type="text" name="last_name"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-5 mb-2 mb-lg-2 col-lg-5">
                <el-form-item label="First name" prop="first_name">
                    <el-input placeholder="First Name" v-model="model.first_name" type="text" name="first_name"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-1 mb-1 mb-lg-1 col-lg-1">
                <el-form-item label="MI" prop="mi">
                    <el-input placeholder="M.I." v-model="model.mi" type="text" name="mi"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Email" prop="email_address">
                    <el-input placeholder="Email Address" v-model="model.email_address" type="email" name="email_address"></el-input>
                </el-form-item>
            </div> 

            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Address" prop="address">
                    <el-input placeholder="Address" v-model="model.address" type="text" name="address"></el-input>
                </el-form-item>
            </div>  

            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Contact Number" prop="contact_number">
                    <el-input placeholder="Contact #" v-model="model.contact_number" type="number" name="contact_number"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-3 mb-2 mb-lg-2 col-lg-3">
                <el-form-item label="ID Number" prop="id_number">
                    <el-input placeholder="ID Number" v-model="model.id_number" type="number" name="id_number"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-3 mb-1 mb-lg-1 col-lg-3">
                <el-form-item label="Status" prop="status">
                    <el-radio-group v-model="model.status">
                        <label class="col-lg-6">
                            <el-radio label="Student" name="status"></el-radio>
                        </label>
                        <label class="col-lg-6">
                            <el-radio label="SC/PWD" name="status"></el-radio>
                        </label>
                    </el-radio-group>
                </el-form-item>
            </div>

            <div class="col-md-6 mb-1 mb-lg-1 col-lg-6">
                <el-form-item label="Nationality" prop="nationality">
                    <el-input placeholder="Nationality" v-model="model.nationality" type="text" name="nationality"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-3 mb-3 mb-lg-3 col-lg-3">
                <el-form-item label="Gender" prop="gender">
                    <el-radio-group v-model="model.gender">
                        <label class="col-lg-5">
                            <el-radio label="Male" name="gender"></el-radio>
                        </label>
                        <label class="col-lg-5">
                            <el-radio label="Female" name="gender"></el-radio>
                        </label>
                    </el-radio-group>
                </el-form-item>
            </div>

            <div class="col-md-12 mb-12 mb-lg-12 col-lg-12">
                <el-form-item label="Purpose" prop="purpose">
                    <el-input v-model="model.purpose" aname="purpose"></el-input>
                </el-form-item>
            </div>
            
            <!-- <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Check In" prop="check_in">
                    <el-date-picker v-model="model.check_in" type="date" name="check_in" ></el-date-picker>
                </el-form-item>
            </div>
            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Check Out" prop="check_out">
                    <el-date-picker v-model="model.check_out" type="date" name="check_out" ></el-date-picker>
                </el-form-item>
            </div> -->

            <!-- <div class="col-md-6 mb-6 mb-lg-6 col-lg-6">
                <el-form-item label="Number of Rooms" prop="number_of_rooms">
                    <el-input v-model="model.number_of_rooms" name="number_of_rooms" type="number" ></el-input>
                </el-form-item>
            </div> -->
                    
            
        </div>
    </el-form>
    

</template>

<script>
export default {
    props: ['date_start', 'date_end', 'number_of_rooms'],
    data(){
        return {
            model: {
                last_name: '',
                first_name: '',
                mi: '',
                email_address: '',
                address: '',
                contact_number: '',
                id_number: '',
                status: '',
                purpose: '',
                gender: '',
                nationality: '',
                check_in: '',
                check_out: '',
                number_of_rooms: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
                number_of_rooms: '',
                status: '',
                check_in: '',
                check_out: '',
            },
            rules: {
                last_name: [{
                    required: true,
                    message: 'Last name is required',
                    trigger: 'blur'
                }],
                first_name: [{
                    required: true,
                    message: 'First name is required',
                    trigger: 'blur'
                }],
                mi: [{
                    required: true,
                    max: 1,
                    message: 'Middle initial is required',
                    trigger: 'blur'
                }],
                email_address: [{
                    required: true,
                    type: 'email',
                    message: 'Email is required',
                    trigger: 'blur'
                }],
                address: [{
                    required: true,
                    message: 'Address is required',
                    trigger: 'blur'
                }],
                contact_number: [{
                    required: true,
                    message: 'Contact number is required',
                    trigger: 'blur'
                }],
                id_number: [{
                    required: true,
                    message: 'ID number is required',
                    trigger: 'blur'
                }],
                status: [{
                    required: true,
                    message: 'Status is required',
                    trigger: 'blur'
                }],
                purpose: [{
                    required: true,
                    message: 'Purpose is required',
                    trigger: 'blur'
                }],
                gender: [{
                    required: true,
                    message: 'Gender is required',
                    trigger: 'blur'
                }],
                nationality: [{
                    required: true,
                    message: 'Nationality is required',
                    trigger: 'blur'
                }],
                // check_in: [{
                //     required: true,
                //     message: 'Check in date is required',
                //     trigger: 'blur'
                // }],
                // check_out: [{
                //     required: true,
                //     message: 'Check out date is required',
                //     trigger: 'blur'
                // }],
                number_of_rooms: [{
                    required: true,
                    message: 'Number of rooms is required',
                    trigger: 'blur'
                }],
            },
        }
    },
    mounted(){
        this.model.check_in = this.date_start;
        this.model.check_out = this.date_end;
        this.model.number_of_rooms = this.number_of_rooms;
    },
    methods: {
        validate() {
            return new Promise((resolve, reject) => {
                this.$refs.form.validate((valid) => {
                this.$emit('on-validate', valid, this.model)
                    resolve(valid);
                });
            })
        }
    }
}
</script>



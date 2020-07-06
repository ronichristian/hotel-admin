<template>
    <el-form :model="model" :rules="rules" ref="form">
        <div class="row">
            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Event Name" prop="event_name">
                    <el-input placeholder="event_name" v-model="model.event_name" type="text" name="event_name"></el-input>
                </el-form-item>
            </div>  
            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Engager's Name" prop="engager_name">
                    <el-input placeholder="engager_name" v-model="model.engager_name" type="text" name="engager_name"></el-input>
                </el-form-item>
            </div>  
            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Address" prop="address">
                    <el-input placeholder="Address" v-model="model.address" type="text" name="address"></el-input>
                </el-form-item>
            </div>  
            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Company" prop="company">
                    <el-input placeholder="Company" v-model="model.company" type="text" name="company"></el-input>
                </el-form-item>
            </div> 
            <div class="col-md-12 mb-2 mb-lg-2 col-lg-12">
                <el-form-item label="Company Address" prop="company_address">
                    <el-input placeholder="Company Address" v-model="model.company_address" type="text" name="company_address"></el-input>
                </el-form-item>
            </div> 
            
            <!--  -->

            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Contact Number" prop="phone_number">
                    <el-input placeholder="Contact #" v-model="model.phone_number" type="number" name="phone_number"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-3 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Email Address" prop="email_address">
                    <el-input placeholder="Email Address" v-model="model.email_address" type="number" name="email_address"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Date of Event" prop="date_of_event">
                    <el-input placeholder="Date of Event" v-model="model.date_of_event" type="number" name="date_of_event"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Venue" prop="venue">
                    <el-input placeholder="Venue" v-model="model.venue" type="number" name="venue"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-3 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="No. of Pax" prop="no_of_pax">
                    <el-input placeholder="No. of Pax" v-model="model.no_of_pax" type="number" name="no_of_pax"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Time of Event" prop="time_of_event">
                    <el-input placeholder="Time of Event" v-model="model.time_of_event" type="number" name="time_of_event"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-3 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Total Payable" prop="total_payable">
                    <el-input placeholder="Total Payable" v-model="model.total_payable" type="number" name="total_payable"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Reciept No." prop="reciept_no">
                    <el-input placeholder="Reciept No." v-model="model.reciept_no" type="number" name="reciept_no"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-3 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Date" prop="date">
                    <el-input placeholder="Date" v-model="model.date" type="date" name="date"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-6 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Amount" prop="amount">
                    <el-input placeholder="Amount" v-model="model.amount" type="number" name="amount"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-3 mb-2 mb-lg-2 col-lg-6">
                <el-form-item label="Balance" prop="balance">
                    <el-input placeholder="Balance" v-model="model.balance" type="number" name="balance"></el-input>
                </el-form-item>
            </div>
            
        </div>
    </el-form>

</template>

<script>
export default {
    props: ['room_categories'],
    data(){
        return {
            disabledDates: {
                from: new Date(Date.now())
            },
            selected: '',
            venues: [],
            model: {
                event_name: '',
                engager_name: '',
                address: '',
                company: '',
                company_address: '',
                phone_number: '',
                email_address: '',
                date_of_event: '',
                venue: '',
                no_of_pax: '',
                time_of_event: '',
                total_payable: '',
                reciept_no: '',
                date: '',
                amount: '',
                balance: '',
            },
            rules: {
                event_name: [{
                    required: true,
                    message: 'Last name is required',
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
                this.model.room_rate = (this.model.number_of_rooms * res.data.room_rate) * finalDiff;
            })
        },

        getVenues () {
            axios.put('/api/get_venues')
            .then(res => {
                this.venues = res.data.data;
            })
            .catch(err => {
                swal("Oops", "Something went wrong", "error");
            })
        },

    }
}
</script>



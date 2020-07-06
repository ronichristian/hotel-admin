<template>
    <!-- <el-form :rules="rules" ref="form">
        <div class="row">
            <div class="col-md-4 mb-2 mb-lg-2 col-lg-4">
                <h3>{{this.category_name}}</h3>
            </div>
             <div class="col-md-3 mb-2 mb-lg-2 col-lg-3">
                <el-form-item label="Room Rate" prop="room_rate">
                    <el-input :value="this.room_rate" type="text"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-3 mb-2 mb-lg-2 col-lg-3">
                <el-form-item label="Nights" prop="nights">
                    <el-input :value="this.nights" type="number"></el-input>
                </el-form-item>
            </div>

            <div class="col-md-5 mb-2 mb-lg-2 col-lg-5">
                <el-form-item label="Check In" prop="check_in">
                    <el-date-picker :value="this.date_start"></el-date-picker>
                </el-form-item>
            </div>
            <div class="col-md-5 mb-2 mb-lg-2 col-lg-5">
                <el-form-item label="Check Out" prop="check_out">
                    <el-date-picker :value="this.date_end"></el-date-picker>
                </el-form-item>
            </div>
        </div>
    </el-form> -->
    <div style="" class="col-md-12 mb-12">
        <div style="border-shadow: 5px 5px 5px 5px; border-radius:5px;" class="block-3 mb-1">
            <div style="background-color:#ededed;"  class="sidebar-box">
                <div class="categories">
                    <h3>RESERVATION DETAILS</h3><hr>
                    <li><a href="#">Room Type: <strong class=" float-right" style="color:green;">{{ this.category_name }}</strong></a>
                    </li>
                    <li>
                        <a href="#">
                            Check in: 
                            <strong class=" float-right" style="color:green;">{{ this.date_start | moment("dddd, MMMM Do YYYY")  }}</strong>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Check out: 
                            <strong class=" float-right" style="color:green;">{{ this.date_end | moment("dddd, MMMM Do YYYY")  }}</strong>
                        </a>
                    </li>
                    <li><a href="#">Total Nights: <strong class=" float-right" style="color:green;">{{ this.nights  }}</strong></a></li>
                    <li><a href="#">No. of Rooms: <strong class=" float-right" style="color:green;">{{ this.number_of_rooms  }}</strong></a></li>
                    <li><a href="#">Room Rate: <strong class=" float-right" style="color:green;">{{ this.room_rate  }}</strong></a></li>
                    <li><a href="#">Total Cost: <strong class=" float-right" style="color:red;">{{ (this.room_rate * this.nights) * this.number_of_rooms }}</strong></a></li>
                </div>
            </div>
        </div>  
    </div>  
    

</template>

<script>
export default {
    props: ['date_start', 'date_end', 'category_name', 'room_rate', 'nights', 'number_of_rooms'],
    data(){
        return {
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
                    message: 'Middle initial is required',
                    trigger: 'blur'
                }],
            },
        }
    },
}
</script>



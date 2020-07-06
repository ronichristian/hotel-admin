<template>
    <div>
        <form-wizard @on-complete="onComplete"
                    title=""
                    subtitle=""
                    @on-loading="setLoading"
                    @on-validate="handleValidation"
                    @on-error="handleErrorMessage"
                    shape="tab"
                    color="#0c9463" required>
            <tab-content title="Personal details" icon="ti-user" :before-change="validateAsync">
            <div class="form-group">
            <label>Check In Date</label>
            <input name="check_in" type="date" class="form-control" required>
            <label>Check In Date</label>
            <input name="check_out" type="date" class="form-control" required>
            <label>Number Of Rooms</label>
            <input name="room_id" type="text" class="form-control" required>
            </div>
            <div class="loader" v-if="loadingWizard"></div>
            <div v-if="errorMsg">
            <span class="error">{{errorMsg}}</span>
            </div>
            </tab-content>
            <tab-content title="Additional Info" icon="ti-settings">

            </tab-content>
            <tab-content title="Last step" icon="ti-check">
                Yuhuuu! This seems pretty damn simple
            </tab-content>
        </form-wizard>
    </div>
</template>

<style>
    span.error{
        color:#e74c3c;
        font-size:20px;
        display:flex;
        justify-content:center;
    }
</style>
<script>
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

export default {
    props: ['data'],
    components: { FormWizard, TabContent },
    data(){
        return {
            loadingWizard: false,
            errorMsg: null,
            count: 0,
        }
    },
    mounted(){
        console.log(this.data);
    },

    methods: {
        
        onComplete (){
            this.bookNow();
        },
        setLoading: function(value) {
            this.loadingWizard = value
        },
        handleValidation: function(isValid, tabIndex){
            console.log('Tab: '+tabIndex+ ' valid: '+isValid)
        },
        handleErrorMessage: function(errorMsg){
            this.errorMsg = errorMsg
        },
        validateAsync () {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if(this.data.number_of_rooms == null){
                        reject('Please fill up the fields')
                    }else{
                        console.log(this.booking.number_of_rooms);
                        resolve(true)
                    }  
                    resolve(false) 
                }, 1000)
            })
        },

       

      
    }
}
</script>
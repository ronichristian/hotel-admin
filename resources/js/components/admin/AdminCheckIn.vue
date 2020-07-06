<template>
    <!-- MODAL  -->
    <div class="modal modal fade bd-example-modal-xl" id="checkIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div style="max-width: 80%; max-height: 20%;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 700; color:green;">{{ category_name.toUpperCase() }}</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form-wizard @on-complete="onComplete"
                                title=""
                                subtitle=""
                                validate-on-back
                                :start-index.sync="activeTabIndex"
                                shape="circle" >
                            <tab-content title="Personal details" icon="ti-user" :before-change="() => validate('CheckInFirstStep')">
                                <check-in-first-step
                                    :room_categories="this.room_categories"  
                                    ref="CheckInFirstStep" 
                                    @on-validate="onStepValidate">
                                </check-in-first-step>
                            </tab-content>
                            <tab-content title="Last step" icon="ti-settings" :before-change="() => validate('CheckInSecondStep')">
                                <check-in-second-step
                                    :room_categories="this.room_categories"  
                                    :booking="this.booking"
                                    ref="CheckInSecondStep" 
                                    @on-validate="onStepValidate">

                                </check-in-second-step>
                                <!-- <pre v-html="prettyJSON"></pre> -->
                            </tab-content>
                            <tab-content title="Last step" icon="ti-check">
                                        Your data
                                    <!-- <pre v-html="prettyJSON"></pre> -->
                            </tab-content>
                        </form-wizard>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import VueFormGenerator from "vue-form-generator";

import Vue from "vue";
import Element from 'element-ui'
import FormWizard from 'vue-form-wizard'
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import locale from 'element-ui/lib/locale/lang/en'
import CheckInFirstStep from "./../FormSteps/CheckInFirstStep.vue";
import CheckInSecondStep from "./../FormSteps/CheckInSecondStep.vue";

Vue.use(Element, { locale })
Vue.use(FormWizard);
Vue.config.productionTip = false;

export default {
    props: ['room_categories', 'calendarEvents'],
    components: { CheckInFirstStep, CheckInSecondStep },
    data(){
        return {
            finalModel: {},
            activeTabIndex: 0,
            errorMsg: '',
            booking: {
                booking_id: '',
                room_cat_id: '',
                room_no: '',
                room_rate: '',
                number_of_rooms: '',
                status: '',
                check_in: '',
                check_out: '',
                total: '',
                user_id: '',
            },
            guest_detail:{
                first_name: '',
                last_name: '',
                mi: '',
                address: '',
                contact: '',
                id_number: '',
                status: '',
                nationality: '',
                gender: '',
                purpose: ''
            },
            user: {
                id: '',
                name: '',
            },
            DatePickerFormat: "dd/MM/yyyy",
            disabledDates: {
                to: new Date(Date.now() - 8640000)
            },
            category_name: '',
            count_room: '',
            room_rate: '',
            events: this.calendarEvents,
        }
    },
    mounted(){
        
    },
    methods: {
        bookNow(){
            swal({
                title: "Are you sure?",
                text: "Confirm Booking",
                icon: "info",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post('/api/walk_in_reservation', this.finalModel)
                    .then(res => {
                        var events = this.calendarEvents = [];
                        console.log(this.events);
                        this.events = [];
                        console.log(this.events);
                        swal("Success", "Check In Successful", "success");
                        $('#checkIn').fadeOut().modal('hide');
                    })
                    .catch(err => {
                        swal("Oops", "Something went wrong", "error");
                    })
                }
            });
        },

        book(room){
            this.booking.user_id = this.$userId;

            this.category_name = room.category_name;
            this.room_rate = room.category_name;
            this.count_room = room.count_room;

            this.booking.number_of_rooms = this.number_of_rooms;
            this.booking.check_in = this.date_start;
            this.booking.check_out = this.date_end;
            this.booking.room_rate = room.room_rate;
            this.booking.room_cat_id = room.room_cat_id;
        },

        validate(ref) {
            return this.$refs[ref].validate();
        },
        onStepValidate(validated, model) {
            if (validated) {
                this.finalModel = { ...this.finalModel, ...model };
            }
        },
        onComplete (){
            this.bookNow();
            setTimeout(function(){

            }, 1000);
        },
    }
}
</script>

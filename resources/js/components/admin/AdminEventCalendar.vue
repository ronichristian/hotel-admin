<template>
<div>
    
    <calendar
            :first-day="1"
            :all-events="events"
            :canAddEvent="true"
            :canDeleteEvent="true"
            @eventAdded="eventAdded"
            @eventDeleted="eventDeleted"
        >
    </calendar>
</div>
</template>
 
<script>
import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);

window.i18n = new VueI18n({
    locale: 'en',
    messages
});

import {Calendar} from 'vue-bootstrap4-calendar';
import {messages} from 'vue-bootstrap4-calendar';

export default {
    name: 'app',
    data() {
        return {
            events: []
        }
    },
    components: {
        Calendar
    },
    methods: {
        eventAdded(event) {
            this.events.push(event);
        },
        eventDeleted(event) {
            this.events.splice(this.events.indexOf(event), 1);
        },
    },
    mounted() {
        let me = this;
        setTimeout(function () {
            me.events = [ // you can make ajax call here
                {
                    id:1,
                    title:'Event 1',
                    description: 'Dummy Desc',
                    backgroundColor: 'card-danger card-inverse',
                    color: 'card-danger card-inverse',
                    date: new Date()
                },
            ];
        }, 1000);
    }
}
</script>
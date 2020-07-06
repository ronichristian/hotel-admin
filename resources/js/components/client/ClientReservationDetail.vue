<template>
    <div class="container">

        <div class="row mb-5 pt-5 justify-content-center">
            <div class="col-md-7 text-center section-heading">
                <h2 class="heading">
                    
                    <a href="/reservation" class="btn btn-primary float-left" >Go Back</a>
                    Reservation No: {{ r[0].id }}
                </h2>
            </div>
        </div>
        <div style="margin-top: -5%;"  class="row">
          <table  border="1" style="white-space:nowrap;" class="table">
                <thead class="thead-dark">
                    <tr style="white-space:nowrap;">
                        <th>Room name</th>
                        <th >Room rate</th>
                        <th>Check in Date</th>
                        <th>Check out Date</th>
                        <th>Nights</th>
                        <th>Status</th>
                        <th>Room No.</th>
                        <th>Total cost</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(res_detail, index) in r" v-bind:key="res_detail.id" >
                        <td align="left" style="white-space:nowrap; font-weight:700;" class="text-success">{{ r[index].category_name }}</td>
                        <td align="right" style="white-space:nowrap;" >{{ r[index].room_rate }}</td>
                        <td align="center" style="white-space:nowrap;" >{{ r[index].check_in | moment("dddd, MMMM Do YYYY") }}</td>
                        <td align="center" style="white-space:nowrap;" >{{ r[index].check_out | moment("dddd, MMMM Do YYYY") }}</td>
                        <td align="center" style="white-space:nowrap;" >{{ r[index].nights }}</td>

                        <td align="center" v-if="r[index].status == 'cancelled'" class="text-danger">{{ r[index].status.toUpperCase() }}</td>
                        <td align="center" v-else-if="r[index].status == 'pending'" style="font-weight:500; color:orange;">{{ r[index].status.toUpperCase() }}</td>
                        <td align="center" v-else-if="r[index].status == 'occupied'" style="font-weight:500; color:blue;">{{ r[index].status.toUpperCase() }}</td>
                        <td align="center" v-else-if="r[index].status == 'checkout'" style="font-weight:500; color:red;">CHECKED OUT</td>
                        <td align="center" v-else class="text-success" style="font-weight:500;">{{ r[index].status.toUpperCase() }}</td>

                        <td align="center" v-if="r[index].room_no == 0" style="white-space:nowrap; font-weight:700;" class="text-success">N/A</td>
                        <td align="center" v-else style="white-space:nowrap; font-weight:700;" class="text-success">{{ r[index].room_no }}</td>

                        <td align="center" style="white-space:nowrap; font-weight:700;" class="text-success">{{ r[index].total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: ['r'],
    data() {
        return {
            bookings: [],
            user: {
                id: '',
                name: '',
            },
        }   
    },

}
</script>
<template>
  <div class="container">
    <loading
      v-model:active="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    />
    <h2 class="text-center text-dark mt-5">List Of Bookings</h2>
    <form>
      <div class="row">
        <div class="form-group col-md-6">
          <VueDatePicker placeholder="Start Date" size="20" v-model="start_date"></VueDatePicker>
        </div>
        <div class="form-group col-md-6">
          <VueDatePicker placeholder="End Date" size="20" v-model="end_date"></VueDatePicker>
        </div>
        <div class="col-auto">
          <br /><button type="submit" class="btn btn-block btn-warning mb-2" @click.prevent="clearFilter()">
          CLEAR FILTER
          </button>
        </div>
        <br />
      </div>
    </form>
    <div class="card">
      <DataTable
        :value="bookings"
        v-model:filters="filters"
        :globalFilterFields="['date_booked']"
        stripedRows
        sortField="date_booked"
        :sortOrder="-1"
        tableStyle="min-width: 50rem"
        paginator :rows="5"
        showGridlines>
        <Column field="booking_id" header="#"></Column>
        <Column field="reason" header="Reason"></Column>
        <Column field="date_booked" header="Date Booked" :sortable="true"></Column>
        <Column field="user.name" header="User"></Column>
        <Column field="user.email" header="Email"></Column>
      </DataTable>
    </div>
  </div>
</template>
<script>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Loading from 'vue-loading-overlay';
import VueDatePicker from '@vuepic/vue-datepicker';
import {
    ref
} from 'vue';
import moment from 'moment';
import {
    useVuelidate
} from '@vuelidate/core';
import {
    required
} from '@vuelidate/validators';

export default {
    setup() {
        const date = ref();
        return {
            v$: useVuelidate(),
            date
        }
    },
    data() {
        return {
            tempBookings: [],
            start_date: '',
            end_date: ''
        };
    },
    validations: {
        start_date: {
            required
        },
        end_date: {
            required
        }
    },
    components: {
        DataTable,
        Column,
        Loading,
        VueDatePicker,
    },
    methods: {
        async filterBookings() {
            this.v$.$touch();
            const result = await this.v$.$validate()
            if (!result) {
                return;
            }
            this.bookings.filter((booking) => {
                return (booking.date_booked >= this.format_date(this.start_date) &&
                    booking.date_booked <= this.format_date(this.end_date))
            });
        },
        clearFilter() {
            this.start_date = '';
            this.end_date = '';
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format('YYYY-MM-DD HH:mm:ss')
            }
        },
    },
    mounted() {
          this.$store.dispatch('getBookings')
    },
    computed: {
        isLoading() {
            return this.$store.getters.getLoadingStatus;
        },

        bookings() {
            let bookings = this.$store.getters.getBookings;
            if (this.start_date == '' && this.end_date == '') {
                return bookings;
            }

            return bookings.filter((booking) => {
                return (booking.date_booked >= this.format_date(this.start_date) &&
                    booking.date_booked <= this.format_date(this.end_date))
            });
        },
    }
}
</script>

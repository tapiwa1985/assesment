<template>
  <div class="container">
    <loading
      v-model:active="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    />
    <div id="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Create New Booking</h2>
        <div class="card my-5">
          <div class="card-body cardbody-color p-lg-5">
            <form>
              <div class="input-group mb-3">
                <VueDatePicker
                  v-model="booking.date_booked"
                  placeholder="Date"
                  size="20"
                ></VueDatePicker>
                <div
                class="input-errors"
                v-for="(error, index) of v$.booking.date_booked.$errors"
                :key="index"
              >
                <div class="error-msg"  style="color: red"><small>{{ error.$message }}</small></div>
              </div>
              </div>
              <div class="input-group mb-3">
                <textarea
                rows="5" cols="50"
                  class="form-control"
                  v-model="booking.reason"
                  placeholder="Reason For Booking"
                  size="20"
                ></textarea>
                <div
                class="input-errors"
                v-for="(error, index) of v$.booking.reason.$errors"
                :key="index"
              >
                <div class="error-msg"  style="color: red"> <small>{{ error.$message }}</small></div>
              </div>
              </div>
              <button @click.prevent="submit" class="btn btn-block btn-success">
                Create Booking
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {
    ref
} from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import Loading from 'vue-loading-overlay';
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
            submitted: false,
            booking: {
                reason: '',
                date_booked: '',
                fullPage: true,
            }
        }
    },
    validations: {
        booking: {
            date_booked: {
                required,
            },
            reason: {
                required
            }
        }
    },
    components: {
        VueDatePicker,
        Loading,
    },
    methods: {
        async submit() {
            this.submitted = true;
            this.v$.$touch();
            const result = await this.v$.$validate()
            if (!result) {
                return;
            }
            this.booking.date_booked = this.format_date(this.booking.date_booked)
            this.$store.dispatch('addBooking', this.booking);
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format('YYYY-MM-DD HH:mm:ss')
            }
        },
        onCancel() {
            console.log('User cancelled the loader.')
        }
    },
    computed: {
        isLoading() {
            return this.$store.getters.getLoadingStatus;
        }
    }
}
</script>

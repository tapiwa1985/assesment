<template>
  <div class="container">
    <loading
      v-model:active="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    />
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Booking App</h2>
        <div class="text-center mb-5 text-dark">Sign In</div>
        <div class="card my-5">
          <div class="card-body cardbody-color p-lg-5">
            <div class="text-center">
              <img
                src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px"
                alt="profile"
              />
            </div>

            <div class="mb-3">
              <input
                type="text"
                class="form-control"
                id="Username"
                aria-describedby="emailHelp"
                placeholder="Email"
                v-model="email"
              />
              <!-- error message -->
              <div
                class="input-errors"
                v-for="(error, index) of v$.email.$errors"
                :key="index"
              >
                <div class="error-msg"  style="color: red"><small>{{ error.$message }}</small></div>
              </div>
            </div>
            <div class="mb-3">
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="password"
                v-model="password"
              />
              <!-- error message -->
              <div
                style="color: red"
                class="input-errors"
                v-for="(error, index) of v$.password.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
            </div>
            <div class="text-center">
              <button
                type="submit"
                @click="submitLogin()"
                class="btn btn-primary px-5 mb-5 w-100"
              >
                Login
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {
    useVuelidate
} from '@vuelidate/core';
import {
    required,
    email
} from '@vuelidate/validators';
import Loading from 'vue-loading-overlay';


export default {
    setup() {
        return {
            v$: useVuelidate()
        }
    },
    data() {
        return {
            email: "",
            password: "",
            fullPage: true,
            submitted: false
        }
    },
    validations: {
        email: {
            required,
            email
        },
        password: {
            required
        },
    },
    components: {
      Loading
    },
    methods: {
        async submitLogin() {
            this.submitted = true;
            this.v$.$touch();
            const result = await this.v$.$validate()
            if (!result) {
                return;
            }
            this.$store.dispatch('login', { email: this.email, password: this.password })
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

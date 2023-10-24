import {
    createStore
} from 'vuex';
import BookingService from '@/services/BookingService';
import {
    useToast
} from 'vue-toast-notification';
import LoginService from '@/services/LoginService';
import router from '@/router/index'

export default createStore({
    state: () => ({
        bookings: [],
        isLoading: false,
        booking: {
            reason: '',
            date_booked: '',
        },
        isLoggedIn: false,
    }),

    actions: {
        getBookings(context) {
            context.commit('SET_LOADING_STATUS', true);
            const $toast = useToast();
            BookingService.fetchAllBookings().then(response => {
                context.commit('SET_LOADING_STATUS', false);
                context.commit('SET_BOOKINGS', response.data.data);
                $toast.open({
                    message: 'Bookings loaded successfully!',
                    type: 'success',
                });
            }).catch(error => {
                console.log(error);
                context.commit('SET_LOADING_STATUS', false);
            });
        },

        addBooking(context, booking) {
            context.commit('SET_LOADING_STATUS', true);
            const $toast = useToast();
            BookingService.createBooking(booking).then(response => {
                context.commit('SET_LOADING_STATUS', false);
                context.commit('SET_BOOKING', response.data.data);
                $toast.open({
                    message: 'Booking created successfully!',
                    type: 'success',
                });
            }).catch(error => {
                console.log(error);
            });
        },

        login(context, credentials) {
            context.commit('SET_LOADING_STATUS', true);
            const $toast = useToast();
            LoginService.login(credentials).then(response => {
                localStorage.setItem('token', response.data.token);
                context.commit('SET_LOGGED_IN_STATUS', true);
                context.commit('SET_LOADING_STATUS', false);
                $toast.open({
                    message: 'Login success!',
                    type: 'success',
                });
                router.push("/bookings/create");
            }).catch(error => {
                console.log(error);
                $toast.open({
                    message: 'Login failed.',
                    type: 'error',
                });
                context.commit('SET_LOADING_STATUS', false);
            });
           
        }
    },

    getters: {
        getBookings(state) {
            return state.bookings;
        },

        getLoadingStatus(state) {
            return state.isLoading;
        },

        getLoggedInStatus(state) {
            return state.loggedInStatus;
        }
    },

    mutations: {
        SET_BOOKINGS(state, bookings) {
            state.bookings = bookings
        },

        SET_BOOKING(state, booking) {
            state.bookings.push(booking)
        },

        SET_LOADING_STATUS(state, loadingStatus) {
            state.isLoading = loadingStatus;
        },

        SET_LOGGED_IN_STATUS(state, loggedInStatus) {
            state.isLoggedIn = loggedInStatus
        }
    }
});
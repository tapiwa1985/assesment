import store from '@/store';

beforeEach(() => {
    store.state.bookings = [];
})
describe('Vuex Store Mutation Test', () => {
    it('Store mutation saves the bookings correctly', () => {

        let bookings = [{
                date_booked: '2023-12-12',
                reason: 'Test'
            },
            {
                date_booked: '2023-11-12',
                reason: 'Test Booking'
            }
        ];
        store.commit('SET_BOOKINGS', bookings)
        expect(store.state.bookings.length).toEqual(2);
        expect(store.state.bookings).toEqual(bookings);
    })
})

describe('Vuex Store Mutation Test', () => {
    it('Store mutation saves the bookings correctly', () => {

        let booking = {
            date_booked: '2023-12-12',
            reason: 'Test'
        };

        store.commit('SET_BOOKING', booking)
        expect(store.state.bookings.length).toEqual(1);
    });

    describe('Store List Bookings Getter', () => {
        it('Test fetch bookings list returns correct list', () => {
            let bookings = [{
                    date_booked: '2023-12-12',
                    reason: 'Test'
                },
                {
                    date_booked: '2023-11-12',
                    reason: 'Test Booking'
                },
                {
                    date_booked: '2023-12-12',
                    reason: 'Test'
                }
            ];
            store.state.bookings = bookings;
            const actual = store.getters.getBookings;
            expect(actual).toEqual(bookings)
        })
    })
})
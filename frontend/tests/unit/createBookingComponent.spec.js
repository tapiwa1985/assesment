import {
    mount
} from '@vue/test-utils';
import CreateBookingComponent from '@/components/bookings/CreateBookingComponent';
import {
    createStore
} from 'vuex'

const store = createStore({
    state() {
        return {
            bookings: []
        }
    },
    gettergs: {
        getLoadingStatus(state) {
            state = true
        }
    }
})
describe('Create Booking Component', () => {
    it('calls the submit function', async () => {
        const wrapper = mount(CreateBookingComponent, {
            global: {
                plugins: [store]
            }
        });
        const submit = jest.spyOn(wrapper.vm, 'submit')
        await wrapper.find('button').trigger('click');
        expect(submit).toHaveBeenCalled();
    });
});


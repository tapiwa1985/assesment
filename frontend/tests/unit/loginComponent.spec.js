import { mount } from '@vue/test-utils';
import LoginComponent from '@/components/auth/LoginComponent';
import {
    createStore
} from 'vuex'

const store = createStore({
    state() {
        return {
            isLoading: false,
        }
    },
    gettergs: {
        getLoadingStatus(state) {
            state = true
        }
    }
})

describe('Login Component', () => {
    it('calls the login action correctly', async () => {
        const wrapper = mount(LoginComponent, {
            global: {
                plugins: [store]
            }
        });
        const submitLogin = jest.spyOn(wrapper.vm, 'submitLogin')
        await wrapper.find('button').trigger('click');
        expect(submitLogin).toHaveBeenCalled();
    });
});
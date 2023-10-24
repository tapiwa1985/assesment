import http from '../http-common';

class LoginService 
{
    login(data) {
        return http.post('login', data);
    }
}

export default new LoginService();
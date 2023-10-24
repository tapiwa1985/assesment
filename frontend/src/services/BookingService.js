import http from '../http-common';

class BookingService 
{
    fetchAllBookings() {
        return http.get('bookings');
    }

    createBooking(data) {
        return http.post('bookings', data);
    }
}

export default new BookingService();
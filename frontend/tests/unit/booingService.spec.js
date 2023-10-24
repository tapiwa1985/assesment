import axios from "axios";

const BASE_URL = 'http://localhost:8080/api/v1';

jest.mock("axios");

describe("fetchBookings", () => {
    describe("when API call is successful", () => {
      it("should return booings", async () => {
        const mockResponse = {
            "data": [{
                "date_booked":"2023-12-12 13:00",
                "reason": "Test booking"
            }]
        };
        axios.get.mockImplementation(() => Promise.resolve(mockResponse));
        await axios.get(`${BASE_URL}/bookings`).then((response) => {
            expect(axios.get).toHaveBeenCalledWith(`${BASE_URL}/bookings`);
            expect(response).toEqual(mockResponse);
          });
      });
    });
});
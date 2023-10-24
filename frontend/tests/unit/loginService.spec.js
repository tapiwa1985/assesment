import axios from "axios";

const BASE_URL = 'http://localhost:8080/api/v1';

jest.mock("axios");

describe("submitLogin", () => {
    describe("when API call is successful", () => {
      it("should return api token", async () => {
        const mockResponse = {
            "token": "laravel"
        };
        const request = {
          email: "admin@user.com",
          password: "secret"
        }
        axios.post.mockImplementation(() => Promise.resolve(mockResponse));
        await axios.post(`${BASE_URL}/login`, request).then((response) => {
            expect(axios.post).toHaveBeenCalledWith(`${BASE_URL}/login`, request);
            expect(response).toEqual(mockResponse);
          });
      });
    });
});
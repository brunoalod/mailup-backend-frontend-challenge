import axios from "axios";

export default class Client {
    static API_KEY = '62d5e270c092b4720bca77c3';

    static async get(url, params) {
        return axios.get(url, {
            headers: {
                'app-id': this.API_KEY,
            },
            params: params,
        });
    }
}
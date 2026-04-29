import api from "./api";

export const authApi = {
    async register(userData) {
        const response = await api.post('/register', userData);
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
            localStorage.setItem('user', JSON.stringify(response.data.user));
        }
        return response.data;
    },


    async login(credentials) {
        const response = await api.post('/login', credentials);
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
            localStorage.setItem('user', JSON.stringify(response.data.user));
        }
        return response.data;
    },


    async logout() {
        try {
            await api.post('/logout');
        } catch (error) {
            console.log('Logout error:', error);
        } finally {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
        }
    },


    async getUser() {
        const response = await api.get('/user');
        return response.data;
    },

    async forgotPassword(email) {
        const response = await api.post('/forgot-password', { email });
        return response.data;
    },

    async resetPassword(data) {
        const response = await api.post('/reset-password', data);
        return response.data;
    },


    async sendVerificationEmail() {
        const response = await api.post('/email/verification-notification');
        return response.data;
    },

    async checkVerification() {
        const response = await api.get('/email/check-verification');
        return response.data;
    },


    isAuthenticated() {
        return !!localStorage.getItem('token');
    },

    getUserFromStorage() {
        const user = localStorage.getItem('user');
        return user ? JSON.parse(user) : null;
    },

    getToken() {
        return localStorage.getItem('token');
    },
};
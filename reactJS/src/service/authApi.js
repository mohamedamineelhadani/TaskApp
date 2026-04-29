import api from "./api";

const authApi = {
    login: (credentials) => api.post('/login', credentials),
    register: (userData) => api.post('/register', userData),
    logout: () => api.post('/logout'),
    me: () => api.get('/user'),
    forgotPassword: (email) => api.post('/forgot-password', { email }),
    resetPassword: (data) => api.post('/reset-password', data),
    sendVerificationEmail: () => api.post('/email/verification-notification'),
    checkVerification: () => api.get('/email/check-verification'),
};

export default authApi;
import api from "./api";

export const dashboardApi = {
    getStats: async () => {
        const response = await api.get('/dashboard');
        return response.data;
    },
};


export const profileApi = {
    get: async () => {
        const response = await api.get('/profile');
        return response.data;
    },

    update: async (data) => {
        const response = await api.put('/profile', data);
        return response.data;
    },

    updatePassword: async (data) => {
        const response = await api.put('/profile/password', data);
        return response.data;
    },

    deleteAccount: async (password) => {
        const response = await api.delete('/profile', { data: { password } });
        return response.data;
    },
};


export const projectApi = {
    getAll: async (search = '') => {
        const response = await api.get(`/projects?search=${search}`);
        return response.data;
    },

    getById: async (id) => {
        const response = await api.get(`/projects/${id}`);
        return response.data;
    },

    create: async (data) => {
        const response = await api.post('/projects', data);
        return response.data;
    },

    update: async (id, data) => {
        const response = await api.put(`/projects/${id}`, data);
        return response.data;
    },

    updateStatus: async (id, status) => {
        const response = await api.patch(`/projects/${id}/status`, { status });
        return response.data;
    },

    delete: async (id) => {
        const response = await api.delete(`/projects/${id}`);
        return response.data;
    },
};


export const taskApi = {
    create: async (projectId, data) => {
        const response = await api.post(`/projects/${projectId}/tasks`, data);
        return response.data;
    },

    toggleStatus: async (taskId) => {
        const response = await api.patch(`/tasks/${taskId}/toggle`);
        return response.data;
    },

    completeAll: async (projectId) => {
        const response = await api.post(`/projects/${projectId}/complete-all`);
        return response.data;
    },

    delete: async (taskId) => {
        const response = await api.delete(`/tasks/${taskId}`);
        return response.data;
    },
};


export const contactApi = {
    send: async (data) => {
        const response = await api.post('/contact', data);
        return response.data;
    },
};





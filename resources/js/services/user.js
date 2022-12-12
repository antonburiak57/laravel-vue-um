import { HTTP } from './http'

const urlPrefix = 'user'

const User = {
    changePassword (data) {
        return HTTP.post(`${urlPrefix}/change-password`, data)
    },
    updateProfile (data) {
        return HTTP.post(`${urlPrefix}/profile`, data)
    },
    list (currentPage, perPage, filter) {
        return HTTP.get(`user?currentPage=${currentPage}&perPage=${perPage}&filter=${filter}`)
    },

    show (id) {
        return HTTP.get(`user/${id}`)
    },

    store (user) {
        return HTTP.post('user', user)
    },

    update (user, id) {
        return HTTP.put(`user/${id}`, user)
    },

    delete (id) {
        return HTTP.delete(`user/${id}`)
    }
}

export { User }

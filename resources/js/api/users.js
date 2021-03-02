import axios from 'axios'

export default {
  fetch () {
    return axios.get('/api/v1/users')
  },
  update (user) {
    return axios.put('/api/v1/user', {
      'name': user.full_name,
      'email': user.email
    })
  }
}

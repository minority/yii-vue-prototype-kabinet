import axios from 'axios'

const axiosInstace = axios.create({
  baseURL: process.env.API_URL,
  timeout: 20000
})

const api = (requestType, url, payload) => {
  return new Promise((resolve, reject) => {
    axiosInstace[requestType](url, payload)
      .then(response => {
        resolve(response.data)
      })
      .catch(error => {
        reject(error)
      })
  })
}

export default api

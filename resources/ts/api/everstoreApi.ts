import axios from 'axios'

export const everstoreApi = axios.create({
  baseURL: `${location.origin}/api`
})
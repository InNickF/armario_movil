import { Model as BaseModel } from 'vue-api-query'

export default class Model extends BaseModel {

  // define a base url for a REST API
  baseURL () {
      // console.log(process.env.MIX_API_URL);
    return process.env.MIX_API_URL
  }

  // implement a default request method 
  request (config) {
    return this.$http.request(config)
  }
}
import Model from './Model'
import Product from './Product.js'

export default class Store extends Model {  
  resource()
  {
    return 'stores'
  }

  products () {
    return this.HasMany(Product)
  }

  // computed properties :)
//   get fullname()
//   {
//     return `${this.firstname} ${this.lastname}`
//   }

  // methods :)
//   makeBirthday()
//   {
//     this.age += 1
//   }
}
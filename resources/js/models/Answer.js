import Model from './Model'
import Product from './Product'

export default class Answer extends Model {  
  resource()
  {
    return 'answers'
  }

  question () {
    return this.belongsTo(Product)
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
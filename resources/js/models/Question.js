import Model from './Model'
import Product from './Product'
import Answer from './Answer'

export default class Question extends Model {  
  resource()
  {
    return 'questions'
  }

  product () {
    return this.belongsTo(Product)
  }

  answers () {
    return this.hasMany(Answer)
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
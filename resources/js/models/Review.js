import Model from './Model'
import User from './User'

export default class Review extends Model {  
  resource()
  {
    return 'reviews'
  }

  user () {
    return this.belongsTo(User)
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
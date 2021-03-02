import Model from './Model'

export default class User extends Model {  
  resource()
  {
    return 'users'
  }

  // user () {
  //   return this.belongsTo(User)
  // }


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
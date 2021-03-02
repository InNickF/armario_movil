import Model from './Model'

export default class Address extends Model {  
  resource()
  {
    return 'addresses'
  }

//   store () {
//     return this.belongsTo(Store)
//   }

  // computed properties :)
//   get fullname()
//   {
//     return `${this.firstname} ${this.lastname}`
//   }

  // methods :)
  cleanPrimary()
  {
    this.is_primary = false
  }
}
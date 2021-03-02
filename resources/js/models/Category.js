import Model from './Model'
import Product from './Product'

export default class Category extends Model {  
  resource()
  {
    return 'categories'
  }

  products () {
    return this.belongsTo(Product)
  }


  // computed properties :)
  // get sizes()
  // {
  //   return JSON.parse(this.sizes)
  // }

  // get colors()
  // {
  //   return JSON.parse(this.colors)
  // }

  // methods :)
//   makeBirthday()
//   {
//     this.age += 1
//   }
}
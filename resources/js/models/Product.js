import Model from './Model'
import Store from './Store'
import Category from './Category'

export default class Product extends Model {  
  resource()
  {
    return 'products'
  }

  store () {
    return this.belongsTo(Store)
  }

  // category() {
  //   return this.hasOne(Category)
  // }

  // categories() {
  //   return this.hasMany(Category)
  // }

  // computed properties :)
  // get final_price()
  // {
  //   return parseFloat(this.final_price).toFixed(2)
  // }

  // get colors()
  // {
  //   return JSON.parse(this.colors)
  // }

  // methods :)
  makeFinalPrice()
  {
    return parseFloat(this.final_price).toFixed(2)
  }

  makePrice()
  {
    return parseFloat(this.price).toFixed(2)
  }
}
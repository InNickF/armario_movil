import Model from './Model'
import Store from './Store'
import Product from './Product'

export default class Outfit extends Model {
  resource() {
    return 'outfits'
  }

  store() {
    return this.belongsTo(Store)
  }

  // category() {
  //   return this.hasOne(Category)
  // }

  products() {
    return this.hasMany(Product)
  }

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
  makePrice() {
    return parseFloat(this.price).toFixed(2)
  }

}

import Model from './Model'

export default class PostComment extends Model {  
  resource()
  {
    return 'post_comments'
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
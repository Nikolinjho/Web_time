export default function (user) {
    return new Promise((success, error) => {
      $(".site-carcass__container").load(`/${user.link}`,
      {
        user:{
            name: user.name,            
        }
      }, 
      function(){
          success()
      })  
    })
}
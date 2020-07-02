function setCookie(name, value, {
    hrsToExpire = 12
}={}){
    // let date = new Date();
    // let expires = date.setTime(date.getTime()+(hrsToExpire*60*60*1000))
    // document.cookie = `${name}=${value};expires=${expires.toGMTString}`
    let date = new Date();
    date.setTime(date.getTime()+(hrsToExpire*60*60*1000));
    // document.cookie = name + "=" + value + "; expires=" + date.toGMTString();

    document.cookie = `${name}=${value}; expires=${date.toGMTString()};`
    
}



function getCookie(name) {
    const cookies = document.cookie
        .split(';')
        .map(function(cookie){ 
            return cookie.split('=')
        })
        .reduce((accumulator, [key, value]) => ({ ...accumulator, [key.trim()]: decodeURIComponent(value) }), {});
    return cookies[name]
  }


function eraseCookie(name) {   
    document.cookie = `${name}=; Max-Age=-99999999;`;  
}


  export {setCookie, getCookie, eraseCookie}


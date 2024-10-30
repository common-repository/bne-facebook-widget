(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/'+ bne_fbw_var.language +'/sdk.js#xfbml=1&version=v3.0&appId='+ bne_fbw_var.appid;
  //js.src = '//connect.facebook.net/'+ bne_fbw_var.language +'/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
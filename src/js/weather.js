var input = document.querySelector('.city-name-search');
var main = document.querySelector('.searched-weather-header');
var temp = document.querySelector('#temp');
var desc = document.querySelector('#desc');
//var clouds = document.querySelector('#clouds');
var button= document.querySelector('.search-submit-button');


button.addEventListener('click', function(name){
  fetch('https://api.openweathermap.org/data/2.5/weather?q='+input.value+'&appid=50a7aa80fa492fa92e874d23ad061374&lang=es')//&lang para el json en español
  .then(response => response.json())
  .then(data => {
    var tempValue = data['main']['temp'];
    //esta temperatura está en Kelvin. Tenemos que pasarla a grados centígrados (C = K - 273.15)
    tempValue = (tempValue - 273.15).toFixed(2);//el toFixed es ppara redondear a un numero de decimales adecuado
    var nameValue = data['name'];
    var descValue = data['weather'][0]['description'];
    console.log(data);
    var imageIcon = data['weather'][0]['icon'];//esto nos va a dar un código que usaremos para mostrar un icono u otro
    var shortImageDescription = data['weather'][0]['main'];
    changeBackgroundBasedOnDescription(shortImageDescription);
    main.innerHTML = nameValue;
    desc.innerHTML = "Descripción: "+descValue;
    temp.innerHTML = "Temperatura: "+tempValue + " ºC";

    var img = document.querySelector(".searched-weather-image");
    img.src = "http://openweathermap.org/img/wn/"+imageIcon+"@2x.png";
    
    input.value ="";
  })

  .catch(err => alert("Nombre de ciudad no válido"));
})
function changeBackgroundBasedOnDescription(description){
  var background = document.querySelector('body')
  var darkBackgroundDescriptions = Array("Clouds", "Drizzle", "Thundestorm", "Rain");
  var submitButtonContainer = document.querySelector('.search-submit-button');
  var magnifier = document.querySelector('.search-submit-button-image');
  var span = document.querySelector('.search-submit-button-span');
  if (darkBackgroundDescriptions.includes(description)){
    background.style.background = '#111111';
    background.style.color = '#fafafa';
    magnifier.src = "../../../resources/lupanegra.svg";
    submitButtonContainer.style.background = '#FAFAFA';
    span.style.color = '#111111'
  }
  else {
    background.style.background = '#f1f1f1';
    submitButtonContainer.style.background = '#1F1F1F';
    magnifier.src = "../../../resources/lupablanca.svg";
    background.style.color = 'rgb(37, 37, 37)';
    span.style.color = '#f1f1f1'
  }
}
function showsResult() {
    var searchedWeatherContainer = document.querySelector(".searched-weather-container");
    searchedWeatherContainer.style.display = "flex";
}
<html> 
<head> 
   	<title>Evento onblur</title>

<script> 
function validarEntero(valor){ 
    //intento convertir a entero. 
    //si era un entero no le afecta, si no lo era lo intenta convertir 
    valor = parseInt(valor)

    //Compruebo si es un valor numérico 
    if (isNaN(valor)) { 
       //entonces (no es numero) devuelvo el valor cadena vacia 
       return "" 
    }else{ 
       //En caso contrario (Si era un número) devuelvo el valor 
       return valor 
    } 
}

function compruebaValidoEntero(){ 
   	enteroValidado = validarEntero(document.f1.numero.value) 
   	if (enteroValidado == ""){ 
      	//si era la cadena vacía es que no era válido. Lo aviso 
      	alert ("Debe escribir un entero!") 
      	//selecciono el texto 
      	document.f1.numero.select() 
      	//coloco otra vez el foco 
      	document.f1.numero.focus() 
   	}else 
      	document.f1.numero.value = enteroValidado 
} 
</script> 
</head> 
<body> 
<form name=f1> 
Escriba un número entero: <input type=text name=numero size=8 value="" onblur="compruebaValidoEntero()"> 
</form>

</body> 
</html>
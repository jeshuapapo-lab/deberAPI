const $=id=>document.getElementById(id),form=$('formulario-clima'),input=$('buscar-ciudad'),btn=$('btn-buscar'),carga=$('indicador-carga'),error=$('mensaje-error'),resultado=$('contenedor-clima');

const climaTexto=c=>c===0?'Despejado':[1,2,3].includes(c)?'Parcialmente nublado':[45,48].includes(c)?'Niebla':[51,53,55].includes(c)?'Llovizna':[61,63,65,80,81,82].includes(c)?'Lluvia':[71,73,75,77,85,86].includes(c)?'Nieve':[95,96,99].includes(c)?'Tormenta':'Condiciones variables';
const climaIcono=c=>c===0?'☀️':[1,2,3].includes(c)?'⛅':[45,48].includes(c)?'🌫️':[51,53,55,61,63,65,80,81,82].includes(c)?'🌧️':[71,73,75,77,85,86].includes(c)?'❄️':[95,96,99].includes(c)?'⛈️':'🌍';

function formatearHora(iso,zonaHoraria){
    if(!iso)return'No disponible';
    return new Intl.DateTimeFormat('es-EC',{hour:'2-digit',minute:'2-digit',timeZone:zonaHoraria}).format(new Date(iso));
}

async function buscar(ciudad){
    carga.classList.remove('hidden');
    resultado.classList.add('hidden');
    error.classList.add('hidden');
    btn.disabled=true;

    try{
        const respuesta=await fetch(`api.php?ciudad=${encodeURIComponent(ciudad)}`,{headers:{Accept:'application/json'}});
        const datos=await respuesta.json();

        if(!respuesta.ok){
            throw new Error(datos.error||'No se pudo completar la consulta.');
        }

        $('clima-ciudad').textContent=datos.ciudad;
        $('clima-pais').textContent=datos.pais.nombre;
        $('clima-temp').textContent=Math.round(datos.clima.temperatura);
        $('clima-icono').textContent=climaIcono(datos.clima.codigo);
        $('clima-descripcion').textContent=climaTexto(datos.clima.codigo);
        $('clima-fecha').textContent=datos.clima.fecha.replace('T',' ');
        $('detalle-termica').textContent=`${Math.round(datos.clima.sensacion)} °C`;
        $('detalle-max').textContent=`${Math.round(datos.clima.maxima)} °C`;
        $('detalle-min').textContent=`${Math.round(datos.clima.minima)} °C`;
        $('detalle-humedad').textContent=`${datos.clima.humedad} %`;
        $('detalle-viento').textContent=`${datos.clima.viento} km/h`;
        $('pais-capital').textContent=datos.pais.capital;
        $('pais-moneda').textContent=datos.pais.moneda;
        $('pais-poblacion').textContent=datos.pais.poblacion?datos.pais.poblacion.toLocaleString('es-EC'):'No disponible';
        $('pais-bandera').src=datos.pais.bandera;
        $('sol-amanecer').textContent=formatearHora(datos.sol.amanecer,datos.clima.zonaHoraria);
        $('sol-atardecer').textContent=formatearHora(datos.sol.atardecer,datos.clima.zonaHoraria);
        resultado.classList.remove('hidden');
        localStorage.setItem('ultimaCiudad',datos.ciudad);
    }catch(e){
        error.textContent=e.message;
        error.classList.remove('hidden');
    }finally{
        carga.classList.add('hidden');
        btn.disabled=false;
    }
}

form.addEventListener('submit',e=>{
    e.preventDefault();
    const ciudad=input.value.trim();
    if(!ciudad){
        error.textContent='Escribe una ciudad.';
        error.classList.remove('hidden');
        return;
    }
    buscar(ciudad);
});

document.addEventListener('DOMContentLoaded',()=>{
    const ciudad=localStorage.getItem('ultimaCiudad')||'Guayaquil';
    input.value=ciudad;
    buscar(ciudad);
});
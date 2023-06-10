import { clienteServices } from "./servicios/solicitudes.js";

let salidaIngresos = document.getElementById("lista-ingresos");
const salidaEgresos = document.getElementById("lista-egresos");
const formulario = document.getElementById("forma");
const salidaIngresoTotal = document.getElementById("ingre");
const salidaEgresoTotal = document.getElementById("egre");
const salidaPresupuesto = document.getElementById("presuTot");

formulario.addEventListener("submit", () => {
  const descripcion = document.getElementById("descripcion").value;
  const monto = document.getElementById("valor").value;
  const tipo = document.querySelector("select").value;
  if (tipo === "Ingreso") {
    clienteServices
      .crear(descripcion, monto, tipo)
      .then((respuesta) => console.log(respuesta))
      .catch((error) => console.log(error));
  } else {
    clienteServices
      .crear(descripcion, monto, tipo)
      .then((respuesta) => console.log(respuesta));
  }
});

const templateIngresos = (descripcion, monto, id) => {
  let formateado = formatoMoneda(parseInt(monto));
  let html = `
  <div class="f-content">
    <p class="f-content-descrip">${descripcion}</p>
    <div class="elemnto-list-monto">
    <p class="list-ingre-monto">${formateado}</p>
    <div class="elemento_eliminar">
        <button class="eliminarI" id ="${id}">
        <span class="material-symbols-outlined">delete</span>
        </button>
     </div>
     </div>
     </div>
  `;

  return html;
};

const templateEgresos = (descripion, monto, id) => {
  let formateado = formatoMoneda(parseInt(monto));
  let html = `
    <div class="f-content-egreso">
         <p class="egre-descrip">${descripion}</p>
         <div class="elemnto-list-monto">
                <p class="monto-egre"> -${formateado}</p>       
                <button class="eliminarE" id ="${id}" ">
                <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
            </div>
    `;
  return html;
};

const formatoMoneda = (monto) => {
  return monto.toLocaleString("en-US", { style: "currency", currency: "USD" });
};

const obtenerdatos = async () => {
  const ingreso = await clienteServices.leerIngreso();
  const egresoResponse = await clienteServices.leerEgreso();
  const { records: arrEgresos } = egresoResponse;
  const { records: arrIngresos } = ingreso;
  cargarPagina(arrIngresos, arrEgresos);
};

const cargarPagina = (arrIngreso, arrEgreso) => {
  const ingresoTotal = montosTotales(arrIngreso);
  const egresoTotal = montosTotales(arrEgreso);
  salidaIngresoTotal.innerHTML = formatoMoneda(ingresoTotal);
  salidaEgresoTotal.innerHTML = formatoMoneda(egresoTotal);
  mostrarDatosIngreso(arrIngreso);
  mostrarDatosEgreso(arrEgreso);
  salidaPresupuesto.innerHTML = formatoMoneda(ingresoTotal - egresoTotal);
  const btnEliminarIngreso = document.querySelectorAll(".eliminarI");
  const btnEliminarEgreso = document.querySelectorAll(".eliminarE");
  eliminarIngreso(btnEliminarIngreso);
  eliminarEgreso(btnEliminarEgreso);
};
const mostrarDatosIngreso = (data) => {
  let template = "";
  data.forEach((element) => {
    const { descripcion, monto, id } = element;
    template += templateIngresos(descripcion, monto, id);
  });
  salidaIngresos.innerHTML = template;
};

const mostrarDatosEgreso = (data) => {
  let template = "";
  data.forEach((element) => {
    const { descripcion, monto, id } = element;
    template += templateEgresos(descripcion, monto, id);
  });
  salidaEgresos.innerHTML = template;
};

  const eliminarIngreso= (arrBtn)=>{
    arrBtn.forEach((element)=>{
      element.addEventListener("click", ()=>{
        const id = element.id;
        clienteServices.eliminarIngreso(id);
        location.reload();
      })
    })
}
const eliminarEgreso= (arrBtn)=>{
  console.log(arrBtn);
  arrBtn.forEach((element)=>{
    element.addEventListener("click", ()=>{
      const id = element.id;
      clienteServices.eliminarEgreso(id);
      location.reload();
    })
  })
}
const montosTotales = (data) => {
  return data.reduce((acumulador, elemento) => acumulador + parseInt(elemento.monto),0);
};

obtenerdatos();

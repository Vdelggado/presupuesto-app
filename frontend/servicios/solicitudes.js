
async function leerIngreso (){
    const response = await fetch("http://localhost:8888/apisUwu/backend/apis/leerIngreso.php")
    return await response.json()
}

async function leerEgreso (){
    const response = await fetch("http://localhost:8888/apisUwu/backend/apis/leerEgreso.php")
    return await response.json()
}
 const crear = (descripcion,monto,tipo) =>{
       return  fetch(`http://localhost:8888/apisUwu/backend/apis/insertar${tipo}.php`,{
            method: "POST",
            headers: {
                "content-type": "application/json"
            },
            body: JSON.stringify({descripcion,monto})

        })

 }

 const eliminarIngreso =(id)=> {
    return fetch("http://localhost:8888/apisUwu/backend/apis/deleteIngreso.php",{
        method: "POST",
        headers: {
            "content-type": "application/json"
        },
        body: JSON.stringify({"id": id})
    });
 }

 const eliminarEgreso =(id)=> {
    return fetch("http://localhost:8888/apisUwu/backend/apis/deleteEgreso.php",{
        method: "POST",
        headers: {
            "content-type": "application/json"
        },
        body: JSON.stringify({"id": id})
    });
 }

export const clienteServices ={
    leerIngreso,
    leerEgreso,
    crear,
    eliminarIngreso,
    eliminarEgreso,
}
toastr.options.preventDuplicates = true;
let idReserva="";
let metodoP="";

function idV(v){
    document.getElementById("idVuelo").value=v;
}
function Ppagos(v){
    let max=2500000;
    let min=1500000;
    let CostoT=(Math.floor(Math.random() * (max - min)) + min);
    document.getElementById("gana").value="$ "+((v*700000)-(CostoT)-(2000000));
    document.getElementById("tripu").value="$ "+CostoT;


    
}
    
    

function equipajeM(){
    let v=document.getElementById("check").checked
    if(v==true){
        document.querySelector(".equipaje").style.display = "flex";
    }else{
        document.querySelector(".equipaje").style.display = "none";
    }
}
function reiniciar(){
    location.reload()
}


function pagoc(){

    let cuenta=document.getElementById("cuenta").value;
    let banco=document.getElementById("banco").value;
    let metodoPago="";
    let veri=true;
    if(metodoP==1){
        let fecha=document.getElementById("fecha").value;
        let cvv=document.getElementById("cvv").value;
        metodoPago="Tarjeta de Credito";

        if(cuenta==""){
            toastr.error("Digite el Numero de la Tarjeta de Credito", "Algo ha salido mal")
            veri=false;    
        }
                    

        if(fecha==""){
            toastr.error("Digite la Fecha de Vencimiento", "Algo ha salido mal")
            veri=false;
        }
        if(cvv==""){
            toastr.error("Digite el CVV", "Algo ha salido mal")
            veri=false;
        }
    }else{
        metodoPago="PSE";
         cuenta=document.getElementById("cuenta1").value;
         banco=document.getElementById("banco1").value;


        if(cuenta==""){
            toastr.error("Digite el Correo de la Cuenta", "Algo ha salido mal")
            veri=false; 
        }
    }

    if(banco==""){
        toastr.error("Digite el Banco", "Algo ha salido mal")
        veri=false; 
    }
    
    if(veri){
        let data = new FormData()
        data.append("fpago", metodoPago)
        data.append("cuenta", cuenta)
        data.append("banco", banco)
        data.append("id", idReserva)


        $.ajax({
            url: "http://127.0.0.1:9000/Vista/pagar",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: res => {
                //console.log(res)
                if(res == 1) {
                    
                    document.querySelector(".modal").style.display = "none";
                    toastr.success('Pago Realizado', 'Proceso Exitoso')
                    setTimeout(reiniciar,3500);
                    
                }
                else toastr.error(res, "Algo ha salido mal")
            }
        })
    
    }




}



function pagarR(metodo){
    document.querySelector(".contenido").style.display = "none";
    if(metodo==1){
        document.querySelector(".contenido2").style.display = "flex";
    }else{
        document.querySelector(".contenido3").style.display = "flex";
    }
    metodoP=metodo;
    
    

}
function pagar(id){
    idReserva=id;

}
function eliminarR(id){
    let data = new FormData()
        data.append("id", id)
        $.ajax({
            url: "http://127.0.0.1:9000/Vista/EReserva",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: res => {
                //console.log(res)
                if(res == 1) {
                    
                    reiniciar();
                    
                }
                else toastr.error(res, "Algo ha salido mal")
            }
        })

}

function guardarR(){
    
    let v=document.getElementById("check").checked;
    let idV=document.getElementById("idVuelo").value;
    let Cedula=document.getElementById("Cedula").value;
    let veri=true;
    if(Cedula==""){
        toastr.error("Digite La Cedula del Pasajero", "Algo ha salido mal")
        veri=false;
    }
    let EquipajeTipo="";
    if(v==true){
        EquipajeTipo=document.getElementById("Equipaje").value;
        
        if(EquipajeTipo==""){
            toastr.error("Digite el Equipaje", "Algo ha salido mal")
            veri=false;
        }
    }
    if(veri){
        let data = new FormData()
        data.append("idV", idV)
        data.append("cedula",Cedula)
        data.append("Equipaje", EquipajeTipo)
        $.ajax({
            url: "http://127.0.0.1:9000/Vista/registrarReserva",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: res => {
                //console.log(res)
                if(res == 1) {
                    toastr.success('Reserva Registrada Correcta mente', 'Proceso Exitoso')
                    document.getElementById("idVuelo").value="";
                    document.getElementById("Cedula").value="";
                    document.getElementById("Equipaje").value="";
                    setTimeout(reiniciar,3500);
                    
                }
                else toastr.error(res, "Algo ha salido mal")
            }
        })
    }



        
        


}
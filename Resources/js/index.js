toastr.options.preventDuplicates = true;
function idV(v){
    document.getElementById("idVuelo").value=v;
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
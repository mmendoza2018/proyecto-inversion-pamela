
/* inversionista */

$('#province_id').change(function () {
    var province_id = $(this).val();
    if (province_id != '') {
        $.ajax({
            url: 'get_districts.php', // Ruta al script PHP que obtiene los distritos
            type: 'post',
            data: {
                province_id: province_id
            },
            dataType: 'json',
            success: function (response) {
                console.log('response :>> ', response);
                var len = response.length;
                $('#district_id').empty();
                $('#district_id').append("<option value=''>Seleccione un distrito</option>");
                for (var i = 0; i < len; i++) {
                    var district_id = response[i]['district_id'];
                    var district_name = response[i]['district_name'];
                    $('#district_id').append("<option value='" + district_id + "'>" + district_name + "</option>");
                }
                $('#district_id').prop('disabled', false); // Habilitar el combo box de distrito
            }
        });
    } else {
        $('#district_id').empty();
        $('#district_id').prop('disabled', true); // Deshabilitar el combo box de distrito
    }
});

async function obtenerInversionista(id) {
    try {
        const response = await fetch(`./get_inservionista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("investor_id").value = data.investor_id;
        d.getElementById("department_id").value = data.department_id;
        d.getElementById("username").value = data.username;
        d.getElementById("password").value = data.password;
        d.getElementById("email").value = data.email;
        d.getElementById("province_id").value = data.province_id;
        $('#province_id').trigger('change');
        setTimeout(() => {
            d.getElementById("district_id").value = data.district_id;
        }, 500);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function actualizaInversionista() {
    try {
        let formulario = document.getElementById("formActInservionistas");
        let data = new FormData(formulario);
        let options = {
            method: "POST",
            body: data
        }

        const response = await fetch(`./update_inservionista.php`, options);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        window.location.reload()
        console.log('dataResponse :>> ', dataResponse);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function eliminaInversionista(id) {
    try {
        const response = await fetch(`./delete_inservionista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        console.log('dataResponse :>> ', dataResponse);
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

/* fin inversionista */


/* jefe prestamista */
async function obtenerJefePrestamista(id) {
    try {
        const response = await fetch(`./get_jefePrestamista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("leader_id").value = data.leader_id;
        d.getElementById("department_id").value = data.department_id;
        d.getElementById("username").value = data.username;
        d.getElementById("password").value = data.password;
        d.getElementById("email").value = data.email;
        d.getElementById("phone").value = data.phone;
        d.getElementById("dni").value = data.dni;
        d.getElementById("province_id").value = data.province_id;
        $('#province_id').trigger('change');
        setTimeout(() => {
            d.getElementById("district_id").value = data.district_id;
        }, 500);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function actualizaJefePrestamista() {
    try {
        let formulario = document.getElementById("formActJefePrestamista");
        let data = new FormData(formulario);
        let options = {
            method: "POST",
            body: data
        }

        const response = await fetch(`./update_jefePrestamista.php`, options);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.text();
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function eliminaJefePrestamista(id) {
    try {
        const response = await fetch(`./delete_jefePrestamista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        console.log('dataResponse :>> ', dataResponse);
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

/* fin jefe prestamista */


/* prestamista */
async function obtenerPrestamista(id) {
    try {
        const response = await fetch(`./get_prestamista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("lender_id").value = data.lender_id;
        d.getElementById("department_id").value = data.department_id;
        d.getElementById("username").value = data.username;
        d.getElementById("password").value = data.password;
        d.getElementById("email").value = data.email;
        d.getElementById("phone").value = data.phone;
        d.getElementById("dni").value = data.dni;
        d.getElementById("province_id").value = data.province_id;
        $('#province_id').trigger('change');
        setTimeout(() => {
            d.getElementById("district_id").value = data.district_id;
        }, 500);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function actualizaPrestamista() {
    try {
        let formulario = document.getElementById("formActPrestamista");
        let data = new FormData(formulario);
        let options = {
            method: "POST",
            body: data
        }

        const response = await fetch(`./update_prestamista.php`, options);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.text();
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function eliminaPrestamista(id) {
    try {
        const response = await fetch(`./delete_prestamista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

/* fin prestamista */


/* prestatarios */
async function obtenerPrestatario(id) {
    try {
        const response = await fetch(`./get_prestatarios.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("borrower_id").value = data.borrower_id;
        d.getElementById("department_id").value = data.department_id;
        d.getElementById("username").value = data.username;
        d.getElementById("password").value = data.password;
        d.getElementById("email").value = data.email;
        d.getElementById("phone").value = data.phone;
        d.getElementById("dni").value = data.dni;
        d.getElementById("province_id").value = data.province_id;
        $('#province_id').trigger('change');
        setTimeout(() => {
            d.getElementById("district_id").value = data.district_id;
        }, 500);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function actualizaPrestatario() {
    try {
        let formulario = document.getElementById("formActPrestatario");
        let data = new FormData(formulario);
        let options = {
            method: "POST",
            body: data
        }

        const response = await fetch(`./update_prestatario.php`, options);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.text();
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function eliminaPrestatario(id) {
    try {
        const response = await fetch(`./delete_prestatario.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        window.location.reload()
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function obtenerDetallePrestamo(element) {
    try {
        let idDetalle = element.dataset.id_detalle;
        console.log('idDetalle :>> ', idDetalle);
        const response = await fetch(`./get_detallePrestamo.php?id=${idDetalle}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("amount").value = data.total;
        d.getElementById("det_loan_id").value = data.det_id;
        d.getElementById("days").value = data.days;
        d.getElementById("date_init").value = "";
        

    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}


function realizarOperaciones(element) {
    let monto = document.getElementById("amount").value;
    let dias = document.getElementById("days").value;
    let fechaInicio = element.value;

    let fechaSumada = sumarDias(fechaInicio, dias);
    console.log('fechaSumada :>> ', fechaSumada);

    let diasLaborales = contarDiasLaborables(fechaInicio, fechaSumada);
    console.log('diasLaborales :>> ', diasLaborales);
    let pagoDiario = monto / diasLaborales;
    document.getElementById("date_finish").value = fechaSumada;
    document.getElementById("days").value = dias;
    document.getElementById("amoutUnique").value = pagoDiario;
}

function sumarDias(fechaInicial, dias) {
    // Obtener la fecha del input
    var fecha = new Date(fechaInicial);

    // Calcular la nueva fecha sumando los días
    var newDate = new Date(fecha.getTime() + dias * 24 * 60 * 60 * 1000);

    // Convertir la nueva fecha a un formato legible
    var formattedDate = newDate.getFullYear() + "-" +
        ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" +
        ("0" + newDate.getDate()).slice(-2);

    return formattedDate;
}

function contarDiasLaborables(fechaInicial, fechaFinal) {
    var contador = 0;
    var fechaActual = new Date(fechaInicial);
    var fechaFinalComparacion = new Date(fechaFinal);

    // Establecer la hora de fechaFinalComparacion a las 00:00:00 para incluir ese día en el cálculo
    fechaFinalComparacion.setHours(0, 0, 0, 0);

    // Iterar sobre cada día entre las fechas inicial y final, incluyendo la fecha final
    while (fechaActual <= fechaFinalComparacion) {
        // Verificar si el día actual es de lunes a viernes (de 1 a 5)
        if (fechaActual.getDay() >= 1 && fechaActual.getDay() <= 5) {
            contador++;
        }
        fechaActual.setDate(fechaActual.getDate() + 1); // Avanzar al siguiente día
    }
    return contador - 1;
}

async function solicitarPrestamo(element) {
    try {
        let formulario = document.getElementById("formAddSolicitarPrestamo");
        let data = new FormData(formulario);
        let options = {
            method: "POST",
            body: data
        }

        const response = await fetch(`./add_prestamo.php`, options);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const dataResponse = await response.json();
        if (dataResponse) {
            alert("agregado con exito");
            $("#modalAddPrestamo").modal("hide");
        } else {
            alert("Error");
        }
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}






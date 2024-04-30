async function obtenerInversionista(id) {
    try {
        const response = await fetch(`./get_inservionista.php?id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos');
        }
        const data = await response.json();
        const d = document;
        d.getElementById("investor_id").value = data.investor_id;
        d.getElementById("district_id").value = data.district_id;
        d.getElementById("province_id").value = data.province_id;
        d.getElementById("department_id").value = data.department_id;
        d.getElementById("username").value = data.username;
        d.getElementById("password").value = data.password;
        d.getElementById("email").value = data.email;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}



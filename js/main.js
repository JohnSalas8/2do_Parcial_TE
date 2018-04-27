function cancel_sign_in() {
    var mssg = '';
    
    try {

        var firstname = document.getElementById('firstname').value.trim().toUpperCase();
        var lastnamep = document.getElementById('lastnamep').value.trim().toUpperCase();
        var lastnamem = document.getElementById('lastnamem').value.trim().toUpperCase();
        var email = document.getElementById('email').value.trim();

        document.getElementById('firstname').value = firstname;
        document.getElementById('lastnamep').value = lastnamep;
        document.getElementById('lastnamem').value = lastnamem;
        document.getElementById('email').value = email;

        if (firstname.length==0) {
            mssg += 'El campo nombre esta vacío.<br>';
        } else {
            if (!isName(firstname)) {
                mssg += 'El campo nombre solo letras y espacios.<br>';
            }
        }
    
        if (lastnamep.length==0) {
            mssg += 'El campo apellido paterno esta vacío.<br>';
        } else {
            if (!isName(lastnamep)) {
                mssg += 'El campo apellido paterno solo letras y espacios.<br>';
            }
        }
    
        if (lastnamem.length==0) {
            mssg += 'El campo apellido materno esta vacío.<br>';
        } else {
            if (!isName(lastnamem)) {
                mssg += 'El campo apellido materno solo letras y espacios.<br>';
            }
        }
    
        var radios = document.getElementsByName('sexo');
    
        if (!radios[0].checked && !radios[1].checked) {
            mssg += 'Seleccione su sexo por favor.<br>';
        }

        if (document.getElementById('birthdate').value.length==0) {
            mssg += 'No ha colocado su fecha de nacimiento.<br>';
        }

        if (document.getElementById('ent_fed').options.selectedIndex==0) {
            mssg += 'Seleccione su entidad federativa.<br>';
        }

        if (email.length==0) {
            mssg += 'El campo de correo electrónico esta vacío.';
        } else {
            if (!isEmail(email)) {
                mssg += 'Verifique, su correo puede contener algún caracter no valido.<br>';
            }
        }
    } catch (error) {
        console.log(error.message);
    }

    document.getElementById('mssg').innerHTML = mssg;

    if (mssg=='') {
        return true;
    } else {
        return false;
    }
}

function cancel_show_curp() {
    var mssg = '';

    try {

        var email = document.getElementById('email').value.trim();

        document.getElementById('email').value = email;

        if (email.length==0) {
            mssg += 'El campo de correo electrónico esta vacío.';
        } else {
            if (!isEmail(email)) {
                mssg += 'Verifique, su correo puede contener algún caracter no valido.<br>';
            }
        }
    } catch (error) {
        console.log(error.message);
    }

    if (mssg=='') {
        return true;
    } else {
        return false;
    }
}

function isName(cadena) {
    let regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
    if (cadena.match(regex)) {
        return true;
    } else {
        return false;
    }
}

function isEmail(cadena) {
    let regex = /^([a-zñA-ZÑ0-9_\.\-])+\@(([a-zñA-Zñ0-9\-])+\.)+([a-zñA-Zñ0-9]{2,4})+$/; // Expresion regular para solo habla hispana
    // /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (cadena.match(regex)) {
        return true;
    } else {
        return false;
    }
}
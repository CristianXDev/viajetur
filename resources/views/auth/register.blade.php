<!--le dice al sistema de en que pagina se mostrar este contenido-->
@extends('sources-login')

@section('head-title')

<title>VIAJETUR | REGISTER</title>

@endsection

@section('nav-btn')

<a href="{{ route('login') }}" class="button-primary bold">¡Inicia Sesión!</a>

@endsection

@section('content')

<form action="{{ route('register') }}" method="POST">

    <!--FORM-->
    <div class="form register" id="parte1">

        <!--HEAD FORM-->
        <div class="head-form">

            <img src="{{ asset('static/images/favicon.png') }}" alt="logo">
            <h1>VIAJE<span>TUR</span></h1>

        </div>

        <div>

            <!--BODY FORM-->
            <div class="body-form">

                <label>Nombre</label>
                <div class="item-body-form">
                    <i class="fas fa-user" data-toggle="modal" data-target="#nameModal"></i><input type="text" name="nombre" placeholder="Nombre...">
                </div>

                <label>Apellido</label>
                <div class="item-body-form">
                    <i class="fas fa-user" data-toggle="modal" data-target="#surnameModal"></i><input type="text" name="apellido" placeholder="Apellido...">
                </div>

                <label>Correo</label>
                <div class="item-body-form">
                    <i class="fas fa-envelope" data-toggle="modal" data-target="#emailModal"></i><input type="email" name="email" placeholder="Correo...">
                </div>

                <label>Cedula</label>
                <div class="item-body-form">
                    <i class="fas fa-id-card" data-toggle="modal" data-target="#cedulaModal"></i><input type="text" name="cedula" placeholder="Cedula...">
                </div>

                <label>Contraseña</label>
                <div class="item-body-form">
                    <i class="fas fa-key" data-toggle="modal" data-target="#passwordModal"></i><input type="password" name="password" placeholder="Contraseña...">
                </div>

                <label>Confirmar Contraseña</label>
                <div class="item-body-form">
                    <i class="fas fa-lock" data-toggle="modal" data-target="#repeatPasswordModal"></i><input type="password" name="password_confirmation" placeholder="Confirmar Contraseña...">
                </div>

            </div>

            <!--FOOTER FORM-->
            <div class="footer-form">

                <input type="submit" value="REGISTRAME">

                <span>¿Ya tiene una cuenta?<a href="{{ route('login') }}"> ¡Inicia sesión!</a></span>

            </div>
        </div>
    </div>
    @csrf
</form>

<!--MODAL-->
<div class="modal" id="nameModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user"></i> Requerimientos del campo del nombre</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>El campo del nombre debe ser requerido, es decir, no puede estar vacío.</li>
                    <li>Debe contener únicamente letras del alfabeto, tanto mayúsculas como minúsculas.</li>
                    <li>No debe contener números, caracteres especiales o espacios en blanco.</li>
                    <li>Puede contener un guion medio o un espacio como separador, por ejemplo, María-José o María José.</li>
                    <li>Debe tener una longitud mínima y máxima establecida en el sistema, por ejemplo, entre 2 y 50 caracteres.</li>
                    <li>No debe contener abreviaturas, números romanos o símbolos, como por ejemplo "Dr." o "II".</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="surnameModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user"></i> Requerimientos del campo del apellido</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>El campo del apellido debe ser requerido, es decir, no puede estar vacío.</li>
                    <li>Debe contener únicamente letras del alfabeto, tanto mayúsculas como minúsculas.</li>
                    <li>No debe contener números, caracteres especiales o espacios en blanco.</li>
                    <li>Puede contener un guion medio o un espacio como separador, por ejemplo, García-López o García López.</li>
                    <li>Debe tener una longitud mínima y máxima establecida en el sistema, por ejemplo, entre 2 y 50 caracteres.</li>
                    <li>No debe contener abreviaturas, números romanos o símbolos, como por ejemplo "Jr." o "III".</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="emailModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-envelope"></i> Requerimientos del campo de correo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>Colocar el símbolo "@" seguido del dominio (ejemplo: correo@gmail.com).</li>
                    <li>Verificar que no haya espacios adicionales antes, después o dentro del correo electrónico.</li>
                    <li>Utilizar caracteres permitidos como letras, números, puntos, guiones y guiones bajos.</li>
                    <li>Evitar el uso de caracteres especiales o emoticones en el correo electrónico.</li>
                    <li>Revisar la ortografía y la sintaxis del correo electrónico antes de confirmarlo.</li>
                    <li>Asegurarse de que el dominio del correo electrónico sea válido y esté escrito correctamente.</li>
                    <li>Utilizar un proveedor de correo electrónico confiable y seguro para evitar problemas de seguridad.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="passwordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-key"></i> Requerimientos del campo de contraseña</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>La contraseña debe ser requerida, es decir, no puede estar vacía.</li>
                    <li>Debe tener al menos 8 caracteres de longitud para garantizar su seguridad.</li>
                    <li>Utilizar al menos una letra mayúscula, un número y un carácter especial como !@#$%^&*,.?":<> para aumentar su complejidad.</li>
                    <li>Evitar el uso de información personal como nombres, fechas de nacimiento o palabras comunes.</li>
                    <li>No utilizar patrones predecibles como "12345678" o "password".</li>
                    <li>Considerar el uso de una frase o combinación de palabras que sea fácil de recordar pero difícil de adivinar para otros.</li>
                    <li>Actualizar la contraseña periódicamente para mantener la seguridad de la cuenta.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="repeatPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-lock"></i> Requerimientos del campo de repetir contraseña</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>La contraseña de confirmación debe ser requerida, es decir, no puede estar vacía.</li>
                    <li>Debe tener al menos 8 caracteres de longitud para garantizar su seguridad.</li>
                    <li>Debe coincidir exactamente con la contraseña original para confirmar que ha sido ingresada correctamente.</li>
                    <li>Utilizar al menos una letra mayúscula, un número y un carácter especial como !@#$%^&*,.?":<> para aumentar su complejidad.</li>
                    <li>Evitar el uso de información personal como nombres, fechas de nacimiento o palabras comunes.</li>
                    <li>No utilizar patrones predecibles como "12345678" o "password" para la contraseña de confirmación.</li>
                    <li>Considerar el uso de una frase o combinación de palabras que sea fácil de recordar pero difícil de adivinar para otros.</li>
                    <li>Actualizar la contraseña periódicamente para mantener la seguridad de la cuenta.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="cedulaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-id-card"></i> Requerimientos del campo de cedula</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <h5>[Consideraciones]</h5>
                <ul>
                    <li>La cédula debe ser requerida, es decir, no puede estar vacía.</li>
                    <li>Debe tener un formato numérico válido, por ejemplo, 1234567890.</li>
                    <li>Debe ser única en el sistema, es decir, no puede estar asociada a otro usuario.</li>
                    <li>Puede contener un punto como separador, por ejemplo, 123.456.789.</li>
                    <li>No debe contener letras, caracteres especiales o espacios en blanco.</li>
                    <li>Debe seguir el patrón de validación establecido en el sistema, por ejemplo, mediante una expresión regular que incluya al menos un número.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>









<!--


    <label>Whatsapp</label>
<div class="d-flex align-items-center">
    <select name="extencion" class="form-control border-primary">
        <option value="+58" data-icon="flag-icon flag-icon-ve">+58</option>
        <option value="+52" data-icon="flag-icon flag-icon-mx">+52</option>
        <option value="+51" data-icon="flag-icon flag-icon-pe">+51</option>
    </select>
    <input type="text" name="whatsapp" placeholder="Whatsapp...">
</div>

-->

@endsection
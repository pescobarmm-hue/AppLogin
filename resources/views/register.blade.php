<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Estudiante</title>
</head>
<body>

    <h1>Registro de Estudiante</h1>

    <!-- El formulario apunta a la ruta de almacenamiento de Laravel -->
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        <br><br>

        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        <br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br><br>

        <label for="career_id">Carrera:</label>
        <select id="career_id" name="career_id" required>
            <option value="" disabled selected>Selecciona una opción</option>
            @foreach($careers as $career)
                <option value="{{ $career->id }}" {{ old('career_id') == $career->id ? 'selected' : '' }}>
                    {{ $career->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <input type="checkbox" id="terms_accepted" name="terms_accepted" value="1" required>
        <label for="terms_accepted">Acepto los términos y condiciones</label>
        <br><br>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">                           <!-- Caracteres especiales se ven bien -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Que se vea bien en móviles -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Necesario para Laravel y peticiones POST -->
    <title>Registro de Estudiante</title>            <!-- Título de la pestaña -->

    <!-- Fuente DM Sans desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Los archivos CSS y JS compilados con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="page-wrapper">   <!-- Contenedor principal, centra todo -->

        <!-- Encabezado con el título bonito -->
        <header class="auth-header">
            <h1 class="auth-title">Registro de Estudiante</h1>
            <p class="auth-subtitle">Crea tu cuenta personal</p>
        </header>

        <!-- Si hay errores del servidor, muestro una alerta general -->
        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>Por favor, corrige los errores antes de continuar.</span>
            </div>
        @endif

        <!-- Tarjeta blanca (oscura en realidad) que contiene el formulario -->
        <div class="form-card">
            <!-- Formulario que apunta a la ruta register.store, método POST -->
            <form action="{{ route('register.store') }}" method="POST" id="registerForm" novalidate>
                @csrf   <!-- Token de seguridad de Laravel -->

                <!-- Campo: Nombre completo -->
                <div class="field-group @error('name') has-error @enderror" id="fg-name">
                    <label class="field-label" for="name">Nombre y apellido</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="field-input"
                        value="{{ old('name') }}"
                        autocomplete="name"
                    >
                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo: Correo electrónico -->
                <div class="field-group @error('email') has-error @enderror" id="fg-email">
                    <label class="field-label" for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="field-input"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo: Contraseña -->
                <div class="field-group @error('password') has-error @enderror" id="fg-password">
                    <label class="field-label" for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input has-icon"
                            autocomplete="new-password"
                        >
                        <!-- Botón para mostrar/ocultar la contraseña -->
                        <button type="button" class="toggle-password" data-target="password" aria-label="Mostrar contraseña">
                            <svg class="eye-show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="eye-hide" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94
                                         M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19
                                         m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Las 4 barritas de fortaleza (las pinta el JS) -->
                    <div class="strength-bar" aria-hidden="true">
                        <span></span><span></span><span></span><span></span>
                    </div>
                    <span class="strength-label" id="strength-label" aria-live="polite"></span>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo: Confirmar contraseña -->
                <div class="field-group @error('password_confirmation') has-error @enderror" id="fg-confirm">
                    <label class="field-label" for="password_confirmation">Confirmar contraseña</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="field-input has-icon"
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Mostrar contraseña">
                            <svg class="eye-show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="eye-hide" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94
                                         M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19
                                         m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo: Carrera (select) -->
                <div class="field-group @error('career_id') has-error @enderror" id="fg-career">
                    <label class="field-label" for="career_id">Carrera</label>
                    <div class="select-wrapper">
                        <select
                            id="career_id"
                            name="career_id"
                            class="field-select {{ old('career_id') ? 'has-value' : '' }}"
                        >
                            <option value="" disabled {{ old('career_id') ? '' : 'selected' }}>
                                Selecciona una opción
                            </option>
                            @foreach($careers as $career)
                                <option value="{{ $career->id }}"
                                        {{ old('career_id') == $career->id ? 'selected' : '' }}
                                        title="{{ $career->description ?? 'Sin descripción' }}">
                                    {{ $career->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="select-arrow" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </span>
                    </div>
                    @error('career_id')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Términos y condiciones (checkbox) -->
                <div class="checkbox-group @error('terms_accepted') has-error @enderror" id="fg-terms">
                    <label class="checkbox-label">
                        <input
                            type="checkbox"
                            id="terms"
                            name="terms_accepted"
                            class="checkbox-input"
                            {{ old('terms_accepted') ? 'checked' : '' }}
                        >
                        <span class="checkbox-custom"></span>   <!-- Mi check personalizado con CSS -->
                        <span class="checkbox-text">
                            Acepto los <a href="#" class="link-accent">términos y condiciones</a>
                        </span>
                    </label>
                    @error('terms_accepted')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="btn-spinner" aria-hidden="true"></span>  <!-- Spinner que se ve cuando está cargando -->
                    <span class="btn-text">Registrar</span>
                </button>

            </form>
        </div>

    </div>

    <!-- Modal de éxito  -->
    <div class="modal-overlay" id="successModal" role="dialog" aria-modal="true" aria-labelledby="modal-title" hidden>
        <div class="modal-box">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <h2 class="modal-title" id="modal-title">¡Registro exitoso!</h2>
            <p class="modal-message" id="modal-message">El estudiante ha sido registrado correctamente.</p>
            <button type="button" class="btn-primary modal-btn" id="modalAcceptBtn">
                Aceptar
            </button>
        </div>
    </div>

        <!-- Modal de Términos y Condiciones -->
    <div class="modal-overlay" id="termsModal" role="dialog" aria-modal="true" aria-labelledby="terms-modal-title" hidden>
        <div class="modal-box modal-terms">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            </div>
            <h2 class="modal-title" id="terms-modal-title">Términos y Condiciones</h2>
            <div class="modal-terms-content">
                <p>Al registrarte como estudiante, aceptas lo siguiente:</p>
                <ul>
                    <li>La información proporcionada es veraz y actualizada.</li>
                    <li>Serás responsable de mantener la confidencialidad de tu contraseña.</li>
                    <li>No utilizarás la plataforma para fines ilegales o no autorizados.</li>
                    <li>Te comprometes a respetar las normas de convivencia y el reglamento académico.</li>
                    <li>Los datos personales serán tratados conforme a nuestra política de privacidad.</li>
                </ul>
                <p>La institución se reserva el derecho de modificar estos términos en cualquier momento, notificando los cambios oportunamente.</p>
            </div>
            <button type="button" class="btn-primary modal-btn" id="closeTermsBtn">Cerrar</button>
        </div>
    </div>

    <script>
    // Control del modal de términos (sin interferir con el resto)
    (function() {
        const termsLink = document.querySelector('.link-accent');
        const termsModal = document.getElementById('termsModal');
        const closeTermsBtn = document.getElementById('closeTermsBtn');

        if (termsLink && termsModal) {
            // Abrir modal al hacer clic en el enlace
            termsLink.addEventListener('click', function(e) {
                e.preventDefault();
                termsModal.removeAttribute('hidden');
                closeTermsBtn.focus();
            });

            // Cerrar modal con el botón
            closeTermsBtn.addEventListener('click', function() {
                termsModal.setAttribute('hidden', '');
            });

            // Cerrar con tecla Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && termsModal && !termsModal.hasAttribute('hidden')) {
                    termsModal.setAttribute('hidden', '');
                }
            });

            // Cerrar si se hace clic fuera del contenido (opcional, pero mejora UX)
            termsModal.addEventListener('click', function(e) {
                if (e.target === termsModal) {
                    termsModal.setAttribute('hidden', '');
                }
            });
        }
    })();
    </script>


    <!-- Si Laravel me mandó un mensaje de éxito en sesión, lo guardo en una variable global para que JS lo muestre -->
    @if(session('success'))
        <script>window.__flashSuccess = "{{ session('success') }}";</script>
    @endif

</body>
</html>

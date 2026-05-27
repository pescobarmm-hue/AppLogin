/**
 * app.js
 * Cosas que hago para validar el formulario y que se sienta bonito.
 */

// Cuando el documento ya está listo, empiezo a trabajar
document.addEventListener("DOMContentLoaded", function () {
    /* ── Agarro los elementos que voy a usar ── */
    const form = document.getElementById("registerForm"); // El formulario entero
    const submitBtn = document.getElementById("submitBtn"); // Botón de registrar
    const nameInput = document.getElementById("name"); // Campo nombre
    const emailInput = document.getElementById("email"); // Campo email
    const pwInput = document.getElementById("password"); // Campo contraseña
    const confInput = document.getElementById("password_confirmation"); // Confirmar contraseña
    const careerSel = document.getElementById("career_id"); // Select de carrera
    const termsCb = document.getElementById("terms"); // Checkbox de términos

    /* ── Orden para moverse con Enter: cuando presionan Enter salto al siguiente ── */
    const focusOrder = [
        nameInput,
        emailInput,
        pwInput,
        confInput,
        careerSel,
        termsCb,
        submitBtn,
    ];

    /* ── Mis reglas para validar cada campo ── */
    const rules = {
        // Valido el nombre: no vacío, mínimo 3 letras, solo letras y espacios
        name(value) {
            const v = value.trim();
            if (!v) return "El nombre es requerido.";
            if (v.length < 3) return "Ingresa tu nombre completo.";
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s'\-]+$/.test(v))
                return "Solo se permiten letras y espacios.";
            return null;
        },
        // Valido el correo: no vacío y formato válido
        email(value) {
            const v = value.trim();
            if (!v) return "El correo es requerido.";
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v))
                return "Ingresa un correo electrónico válido.";
            return null;
        },
        // Valido la contraseña: que tenga al menos 8 caracteres
        password(value) {
            if (!value) return "La contraseña es requerida.";
            if (value.length < 8) return "Mínimo 8 caracteres.";
            return null;
        },
        // Valido que la confirmación coincida con la contraseña
        confirm(value) {
            if (!value) return "Confirma tu contraseña.";
            if (value !== pwInput.value) return "Las contraseñas no coinciden.";
            return null;
        },
        // La carrera debe estar seleccionada
        career(value) {
            if (!value) return "Selecciona una carrera.";
            return null;
        },
        // Los términos deben estar aceptados
        terms(checked) {
            if (!checked) return "Debes aceptar los términos y condiciones.";
            return null;
        },
    };

    /* ── Función para mostrar o limpiar el mensaje de error debajo del campo ── */
    function setFieldError(groupId, msg) {
        const group = document.getElementById(groupId);
        if (!group) return;
        // Pongo o quito la clase 'has-error' (cambia el borde a rojo)
        group.classList.toggle("has-error", Boolean(msg));

        let errorEl = group.querySelector(".field-error");
        if (msg) {
            // Si no existe el mensaje de error, lo creo
            if (!errorEl) {
                errorEl = document.createElement("span");
                errorEl.className = "field-error";
                group.appendChild(errorEl);
            }
            errorEl.textContent = msg;
        } else if (errorEl) {
            // Si no hay error, borro el mensaje
            errorEl.remove();
        }
    }

    /* ── Lo de la fortaleza de la contraseña ── */
    const strengthBars = document.querySelectorAll(".strength-bar span"); // Las 4 barritas
    const strengthLabel = document.getElementById("strength-label"); // Texto "Débil", "Fuerte", etc.

    const STRENGTH_LEVELS = [
        { color: "", label: "" },
        { color: "#f85149", label: "Débil" },
        { color: "#e3b341", label: "Regular" },
        { color: "#3fb950", label: "Fuerte" },
        { color: "#58a6ff", label: "Muy fuerte" },
    ];

    // Calculo qué tan segura es la contraseña (puntaje de 0 a 4)
    function getPasswordStrength(pw) {
        let score = 0;
        if (pw.length >= 8) score++;
        if (pw.length >= 12) score++;
        if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
        if (/\d/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;
        return Math.min(4, Math.ceil((score * 4) / 5));
    }

    // Pinto las barritas y el texto según la contraseña actual
    function updateStrengthUI(pw) {
        if (!strengthBars.length || !strengthLabel) return;
        if (!pw) {
            strengthBars.forEach((b) => (b.style.background = ""));
            strengthLabel.textContent = "";
            return;
        }
        const level = getPasswordStrength(pw);
        const { color, label } = STRENGTH_LEVELS[level];
        strengthBars.forEach((bar, i) => {
            bar.style.background = i < level ? color : "var(--border)";
        });
        strengthLabel.textContent = label;
        strengthLabel.style.color = color;
    }

    /* ── Botones para mostrar / ocultar la contraseña ── */
    document.querySelectorAll(".toggle-password").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const input = document.getElementById(this.dataset.target);
            const eyeShow = this.querySelector(".eye-show");
            const eyeHide = this.querySelector(".eye-hide");
            if (!input) return;

            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            if (eyeShow) eyeShow.style.display = isPassword ? "none" : "";
            if (eyeHide) eyeHide.style.display = isPassword ? "" : "none";
            this.setAttribute(
                "aria-label",
                isPassword ? "Ocultar contraseña" : "Mostrar contraseña",
            );
        });
    });

    /* ── Al presionar Enter, me muevo al siguiente campo ── */
    focusOrder.forEach(function (el, index) {
        if (!el || el === submitBtn) return;
        el.addEventListener("keydown", function (e) {
            if (e.key !== "Enter") return;
            e.preventDefault(); // Evito que se envíe el formulario por error
            const next = focusOrder[index + 1];
            if (next) next.focus();
        });
    });

    /* ── Validación por campo: solo cuando el usuario lo tocó y sale del campo ── */
    const touched = new Set(); // Aquí guardo qué campos ya fueron visitados

    function watchField(input, groupId, ruleFn) {
        if (!input) return;
        input.addEventListener("focus", () => touched.add(groupId));
        input.addEventListener("blur", () => {
            if (touched.has(groupId)) {
                setFieldError(groupId, ruleFn(input.value));
            }
        });
    }

    // Aplico la validación a nombre y email
    watchField(nameInput, "fg-name", (v) => rules.name(v));
    watchField(emailInput, "fg-email", (v) => rules.email(v));

    // Contraseña: actualizo la fortaleza en tiempo real, pero valido solo al salir
    pwInput &&
        pwInput.addEventListener("focus", () => touched.add("fg-password"));
    pwInput &&
        pwInput.addEventListener("input", function () {
            updateStrengthUI(this.value);
            if (touched.has("fg-password-blurred")) {
                setFieldError("fg-password", rules.password(this.value));
            }
            // Si la confirmación ya fue tocada, la valido al escribir la contraseña
            if (
                touched.has("fg-confirm-blurred") &&
                confInput &&
                confInput.value
            ) {
                setFieldError("fg-confirm", rules.confirm(confInput.value));
            }
        });
    pwInput &&
        pwInput.addEventListener("blur", function () {
            touched.add("fg-password-blurred");
            if (touched.has("fg-password")) {
                setFieldError("fg-password", rules.password(this.value));
            }
        });

    // Confirmación: igual, valido solo cuando sale si ya la tocó
    confInput &&
        confInput.addEventListener("focus", () => touched.add("fg-confirm"));
    confInput &&
        confInput.addEventListener("input", function () {
            if (touched.has("fg-confirm-blurred")) {
                setFieldError("fg-confirm", rules.confirm(this.value));
            }
        });
    confInput &&
        confInput.addEventListener("blur", function () {
            touched.add("fg-confirm-blurred");
            if (touched.has("fg-confirm")) {
                setFieldError("fg-confirm", rules.confirm(this.value));
            }
        });

    // Carrera: cuando cambia, valido al momento
    careerSel &&
        careerSel.addEventListener("change", function () {
            this.classList.toggle("has-value", Boolean(this.value));
            setFieldError("fg-career", rules.career(this.value));
        });

    /* ── Cuando intentan enviar el formulario, reviso todo otra vez ── */
    if (form && submitBtn) {
        form.addEventListener("submit", function (e) {
            const errors = {
                "fg-name": rules.name(nameInput ? nameInput.value : ""),
                "fg-email": rules.email(emailInput ? emailInput.value : ""),
                "fg-password": rules.password(pwInput ? pwInput.value : ""),
                "fg-confirm": rules.confirm(confInput ? confInput.value : ""),
                "fg-career": rules.career(careerSel ? careerSel.value : ""),
                "fg-terms": rules.terms(termsCb ? termsCb.checked : false),
            };

            const hasErrors = Object.values(errors).some(Boolean);
            // Muestro todos los errores que encontré
            Object.entries(errors).forEach(([id, msg]) =>
                setFieldError(id, msg),
            );

            if (hasErrors) {
                e.preventDefault(); // Detengo el envío
                const firstError = form.querySelector(
                    ".has-error input, .has-error select",
                );
                if (firstError) firstError.focus();
                return;
            }

            // Si todo está bien, deshabilito el botón y muestro el spinner
            submitBtn.disabled = true;
            submitBtn.classList.add("is-loading");
            const btnText = submitBtn.querySelector(".btn-text");
            if (btnText) btnText.textContent = "Registrando…";
        });
    }

    /* ── Modal de éxito (ese que aparece cuando todo salió bien) ── */
    const successModal = document.getElementById("successModal");
    const modalMessage = document.getElementById("modal-message");
    const modalAcceptBtn = document.getElementById("modalAcceptBtn");

    function showSuccessModal(message) {
        if (!successModal) return;

        if (message && modalMessage){
            modalMessage.textContent = message;
        }

        successModal.removeAttribute("hidden");
        if (modalAcceptBtn) modalAcceptBtn.focus();
    }

    // Cuando hacen clic en "Aceptar", cierro el modal y reseteo el formulario
    modalAcceptBtn &&
        modalAcceptBtn.addEventListener("click", function () {
            successModal.setAttribute("hidden", "");
            if (form) {
                form.reset();
                if (careerSel) careerSel.classList.remove("has-value");
                updateStrengthUI("");
                document
                    .querySelectorAll(".has-error")
                    .forEach((el) => el.classList.remove("has-error"));
                touched.clear(); // Para que los campos se consideren "no tocados" de nuevo
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove("is-loading");
                    const btnText = submitBtn.querySelector(".btn-text");
                    if (btnText) btnText.textContent = "Registrar";
                }
                if (nameInput) nameInput.focus();
            }
        });

    // Si presionan Escape, cierro el modal también
    document.addEventListener("keydown", function (e) {
        if (
            e.key === "Escape" &&
            successModal &&
            !successModal.hasAttribute("hidden")
        ) {
            modalAcceptBtn && modalAcceptBtn.click();
        }
    });

    // Dejo la función disponible por si quieren usarla desde otro lado
    window.showSuccessModal = showSuccessModal;

    /* ── Leo si hay un mensaje de éxito en la sesión (Laravel) ── */
    if (window.__flashSuccess) {
        showSuccessModal(window.__flashSuccess);
        window.__flashSuccess = null;
    }
});

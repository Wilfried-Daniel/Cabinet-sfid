document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contact-form");
    const submitBtn = document.getElementById("submit-btn");

    const fields = {
        fullname: {
            input: document.getElementById("fullname"),
            msg: document.getElementById("msg-fullname"),
            validate: val => val.trim().length >= 2 ? null : "Veuillez entrer au moins 2 caractères."
        },
        phone: {
            input: document.getElementById("phone"),
            msg: document.getElementById("msg-phone"),
            validate: val => {
                const phoneRegex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
                if (!val.trim()) return "Le numéro de téléphone est requis.";
                if (!phoneRegex.test(val) || val.trim().length < 8) return "Format de téléphone invalide (ex: +225 07 00 00 00 00).";
                return null;
            }
        },
        email: {
            input: document.getElementById("email"),
            msg: document.getElementById("msg-email"),
            validate: val => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!val.trim()) return "L'adresse email est requise.";
                if (!emailRegex.test(val)) return "Veuillez entrer un email valide (ex: nom@domaine.ci).";
                return null;
            }
        },
        service: {
            input: document.getElementById("service"),
            msg: document.getElementById("msg-service"),
            validate: val => val !== "" ? null : "Veuillez sélectionner un service dans la liste."
        },
        message: {
            input: document.getElementById("message"),
            msg: document.getElementById("msg-message"),
            validate: val => val.trim().length >= 10 ? null : `Encore ${10 - val.trim().length} caractère(s) minimum.`
        }
    };

    // État d'interaction pour éviter d'afficher des erreurs rouges avant que l'utilisateur n'ait touché au champ
    const touched = {};

    function validateField(key) {
        const field = fields[key];
        const error = field.validate(field.input.value);

        // Si le champ n'a pas encore été touché par l'utilisateur, on ne montre pas la couleur d'erreur
        if (!touched[key]) return error === null;

        if (error) {
            field.input.classList.remove("border-slate-700", "border-emerald-500", "focus:ring-2", "focus:ring-blue-500/50");
            field.input.classList.add("border-red-500", "focus:ring-2", "focus:ring-red-500/50");
            field.msg.textContent = error;
            field.msg.className = "text-xs mt-1.5 text-red-400 block";
            return false;
        } else {
            field.input.classList.remove("border-slate-700", "border-red-500", "focus:ring-2", "focus:ring-red-500/50");
            field.input.classList.add("border-emerald-500", "focus:ring-2", "focus:ring-emerald-500/50");
            field.msg.textContent = "✓ Champ valide";
            field.msg.className = "text-xs mt-1.5 text-emerald-400 block";
            return true;
        }
    }

    function checkOverallForm() {
        let isFormValid = true;

        Object.keys(fields).forEach(key => {
            const isValid = fields[key].validate(fields[key].input.value) === null;
            if (!isValid) isFormValid = false;
        });

        if (isFormValid) {
            submitBtn.disabled = false;
            submitBtn.className = "w-full sm:w-auto bg-blue-600 hover:bg-blue-500 text-white cursor-pointer text-sm font-semibold px-6 py-3 rounded-xl transition-all duration-300 shadow-lg shadow-blue-600/30";
        } else {
            submitBtn.disabled = true;
            submitBtn.className = "w-full sm:w-auto bg-slate-700 text-slate-400 opacity-50 cursor-not-allowed text-sm font-semibold px-6 py-3 rounded-xl transition-all duration-300";
        }
    }

    // Ajout des événements en temps réel sur chaque champ
    Object.keys(fields).forEach(key => {
        const input = fields[key].input;

        // Lorsque l'utilisateur tape ou change la sélection
        input.addEventListener("input", () => {
            touched[key] = true;
            validateField(key);
            checkOverallForm();
        });

        // Quand l'utilisateur quitte le champ
        input.addEventListener("blur", () => {
            touched[key] = true;
            validateField(key);
            checkOverallForm();
        });
    });
});
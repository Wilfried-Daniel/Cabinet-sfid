document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("spontanee-form");
    const submitBtn = document.getElementById("btn-submit-spontanee");

    const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 Mo en octets
    const ALLOWED_EXTENSIONS = ["pdf", "doc", "docx"];

    // Validation spécifique pour les fichiers CV / LM
    function validateFileInput(fileInput) {
        const file = fileInput.files[0];
        if (!file) return "Veuillez sélectionner un fichier.";

        const ext = file.name.split('.').pop().toLowerCase();
        if (!ALLOWED_EXTENSIONS.includes(ext)) {
            return "Format invalide (seuls .pdf, .doc, .docx sont acceptés).";
        }

        if (file.size > MAX_FILE_SIZE) {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            return `Fichier trop lourd (${sizeInMB} Mo). La limite est de 5 Mo.`;
        }

        return null;
    }

    const fields = {
        nom: {
            input: document.getElementById("spontanee-nom"),
            msg: document.getElementById("msg-spontanee-nom"),
            validate: val => val.trim().length >= 2 ? null : "Veuillez saisir votre nom complet (min 2 caractères)."
        },
        email: {
            input: document.getElementById("spontanee-email"),
            msg: document.getElementById("msg-spontanee-email"),
            validate: val => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!val.trim()) return "L'adresse email est obligatoire.";
                if (!regex.test(val.trim())) return "Adresse email invalide.";
                return null;
            }
        },
        telephone: {
            input: document.getElementById("spontanee-telephone"),
            msg: document.getElementById("msg-spontanee-telephone"),
            validate: val => {
                const regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
                if (!val.trim()) return "Le téléphone est obligatoire.";
                if (!regex.test(val.trim()) || val.trim().length < 8) return "Numéro de téléphone invalide.";
                return null;
            }
        },
        domaine: {
            input: document.getElementById("spontanee-domaine"),
            msg: document.getElementById("msg-spontanee-domaine"),
            validate: val => val !== "" ? null : "Veuillez sélectionner un domaine."
        },
        cv: {
            input: document.getElementById("spontanee-cv"),
            msg: document.getElementById("msg-spontanee-cv"),
            validate: () => validateFileInput(document.getElementById("spontanee-cv"))
        },
        lm: {
            input: document.getElementById("spontanee-lm"),
            msg: document.getElementById("msg-spontanee-lm"),
            validate: () => validateFileInput(document.getElementById("spontanee-lm"))
        }
    };

    const touched = {};

    function updateFieldState(key) {
        const field = fields[key];
        const error = field.validate(field.input.value);

        if (!touched[key]) return error === null;

        if (error) {
            field.input.classList.remove("border-blue-200", "border-emerald-500", "dark:border-white/20", "dark:border-emerald-400", "focus:ring-2", "focus:ring-blue-500/20");
            field.input.classList.add("border-red-500", "dark:border-red-400", "focus:ring-2", "focus:ring-red-500/20");
            field.msg.textContent = error;
            field.msg.className = "mt-1.5 block text-xs font-medium text-red-500 dark:text-red-400";
            return false;
        } else {
            field.input.classList.remove("border-blue-200", "border-red-500", "dark:border-white/20", "dark:border-red-400", "focus:ring-2", "focus:ring-red-500/20");
            field.input.classList.add("border-emerald-500", "dark:border-emerald-400", "focus:ring-2", "focus:ring-emerald-500/20");
            field.msg.textContent = "✓ Valide";
            field.msg.className = "mt-1.5 block text-xs font-medium text-emerald-600 dark:text-emerald-400";
            return true;
        }
    }

    function checkFormValidity() {
        let isValid = true;
        Object.keys(fields).forEach(key => {
            if (fields[key].validate(fields[key].input.value) !== null) {
                isValid = false;
            }
        });

        if (isValid) {
            submitBtn.disabled = false;
            submitBtn.className = "font-inter inline-flex cursor-pointer items-center gap-2 rounded-xl bg-blue-950 px-5 py-3 text-sm font-semibold text-white shadow-lg transition-transform hover:-translate-y-1 hover:bg-blue-900 dark:bg-violet-300 dark:text-blue-950 dark:hover:bg-violet-200 opacity-100";
        } else {
            submitBtn.disabled = true;
            submitBtn.className = "font-inter inline-flex cursor-not-allowed items-center gap-2 rounded-xl bg-slate-300 px-5 py-3 text-sm font-semibold text-slate-500 opacity-60 transition-all dark:bg-slate-700 dark:text-slate-400";
        }
    }

    Object.keys(fields).forEach(key => {
        const input = fields[key].input;
        const events = (input.type === "file" || input.tagName === "SELECT") ? ["change"] : ["input", "blur"];

        events.forEach(evt => {
            input.addEventListener(evt, () => {
                touched[key] = true;
                updateFieldState(key);
                checkFormValidity();
            });
        });
    });
});
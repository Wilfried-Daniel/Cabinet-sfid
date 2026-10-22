# 📂 Explication Ligne par Ligne du Code de Validation (Candidature Spontanée)

Ce guide explique simplement comment fonctionne ce script JavaScript. Ce code sert à vérifier qu'un utilisateur remplit correctement un formulaire de candidature (avec son nom, email, téléphone, et surtout ses fichiers comme le **CV** et la **lettre de motivation**).

---

## 1. Le démarrage du script

```javascript
document.addEventListener("DOMContentLoaded", () => {
```
* **Ce que ça fait :** Cette ligne attend que toute la page web (le HTML) soit bien chargée par le navigateur avant de lancer le code JavaScript. Cela évite les bugs si le code cherche un bouton qui n'existe pas encore.

---

## 2. La sélection des éléments importants

```javascript
    const form = document.getElementById("spontanee-form");
    const submitBtn = document.getElementById("btn-submit-spontanee");
```
* **`form`** : Va chercher le formulaire complet dans la page grâce à son identifiant unique (`spontanee-form`).
* **`submitBtn`** : Va chercher le bouton d'envoi du formulaire (`btn-submit-spontanee`). On en aura besoin pour l'allumer ou l'éteindre.

---

## 3. Les règles pour les fichiers (CV et Lettre de Motivation)

```javascript
    const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 Mo en octets
    const ALLOWED_EXTENSIONS = ["pdf", "doc", "docx"];
```
* **`MAX_FILE_SIZE`** : C'est la taille maximale autorisée pour un fichier. Les ordinateurs comptent en "octets". `5 * 1024 * 1024` calcule exactement la taille de **5 Mégaoctets (Mo)**.
* **`ALLOWED_EXTENSIONS`** : C'est la liste des formats de fichiers acceptés. Ici, l'utilisateur a le droit d'envoyer seulement du PDF ou du Word (`.doc`, `.docx`).

---

## 4. La fonction magique pour vérifier les fichiers

Cette fonction reçoit un fichier et vérifie s'il respecte les règles définies juste au-dessus.

```javascript
    function validateFileInput(fileInput) {
        const file = fileInput.files[0];
        if (!file) return "Veuillez sélectionner un fichier.";
```
* **`fileInput.files[0]`** : Récupère le premier fichier sélectionné par l'utilisateur.
* **`if (!file)`** : Si l'utilisateur n'a choisi aucun fichier, la fonction s'arrête et renvoie le message d'erreur : *"Veuillez sélectionner un fichier."*

```javascript
        const ext = file.name.split('.').pop().toLowerCase();
        if (!ALLOWED_EXTENSIONS.includes(ext)) {
            return "Format invalide (seuls .pdf, .doc, .docx sont acceptés).";
        }
```
* **`file.name.split('.').pop()`** : Découpe le nom du fichier au niveau des points et prend le tout dernier morceau pour obtenir l'extension (par exemple `pdf` ou `png`).
* **`.toLowerCase()`** : Transforme l'extension en lettres minuscules (pour que `PDF` ou `pdf` soient traités de la même manière).
* **`if (!ALLOWED_EXTENSIONS.includes(ext))`** : Vérifie si cette extension est bien dans notre liste autorisée. Si elle n'y est pas, on renvoie une erreur.

```javascript
        if (file.size > MAX_FILE_SIZE) {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            return `Fichier trop lourd (${sizeInMB} Mo). La limite est de 5 Mo.`;
        }

        return null;
    }
```
* **`if (file.size > MAX_FILE_SIZE)`** : Si le fichier est plus grand que 5 Mo, c'est trop lourd !
* **`(file.size / ...).toFixed(2)`** : Convertit les octets en Mégaoctets lisibles (ex: `6.45 Mo`) avec deux chiffres après la virgule.
* **`return null;`** : Si le fichier passe toutes les vérifications sans problème, on renvoie `null` (ce qui signifie "aucune erreur, tout est parfait").

---

## 5. La grande liste des champs à vérifier (`fields`)

Ici, on crée un grand dictionnaire (un objet) qui regroupe tous les champs du formulaire. Pour chaque champ, on indique son **input**, la zone où afficher le **message** d'erreur, et la règle de **validation**.

```javascript
    const fields = {
```

### Le Nom
```javascript
        nom: {
            input: document.getElementById("spontanee-nom"),
            msg: document.getElementById("msg-spontanee-nom"),
            validate: val => val.trim().length >= 2 ? null : "Veuillez saisir votre nom complet (min 2 caractères)."
        },
```
* **Règle :** On enlève les espaces vides au début et à la fin (`.trim()`). Si le texte fait moins de 2 caractères, on affiche une erreur.

### L'Email
```javascript
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
```
* **`regex`** : Une formule mathématique textuelle pour vérifier la structure d'un email (présence du `@` et d'un point `.`).
* **Règle :** Le champ ne doit pas être vide, et l'email doit ressembler à un vrai email.

### Le Téléphone
```javascript
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
```
* **Règle :** Le téléphone est obligatoire, doit contenir uniquement des chiffres (ou des signes comme `+` pour l'indicatif pays) et faire au moins 8 caractères.

### Le Domaine (Liste déroulante)
```javascript
        domaine: {
            input: document.getElementById("spontanee-domaine"),
            msg: document.getElementById("msg-spontanee-domaine"),
            validate: val => val !== "" ? null : "Veuillez sélectionner un domaine."
        },
```
* **Règle :** L'utilisateur doit obligatoirement choisir une option dans la liste (la valeur ne doit pas être vide).

### Le CV et la Lettre de Motivation (LM)
```javascript
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
```
* **Règle :** Pour ces deux champs de type "fichier", on appelle la fonction `validateFileInput` que nous avons expliquée à l'étape 4.

---

## 6. Gestion du "Premier Contact" (`touched`)

```javascript
    const touched = {};
```
* **Pourquoi ?** C'est une boîte vide au départ. Elle va servir à mémoriser les champs que l'utilisateur a commencés à remplir. Cela évite d'afficher des messages d'erreur en rouge dès l'ouverture de la page alors que l'utilisateur n'a encore rien écrit.

---

## 7. La mise à jour visuelle d'un champ (`updateFieldState`)

Cette fonction s'occupe de changer la couleur des bordures en temps réel (Vert si c'est bon, Rouge s'il y a une erreur). Elle utilise des classes de style **Tailwind CSS**.

```javascript
    function updateFieldState(key) {
        const field = fields[key];
        const error = field.validate(field.input.value);

        if (!touched[key]) return error === null;
```
* On extrait le champ actuel et on cherche s'il contient une erreur.
* **`if (!touched[key])`** : Si l'utilisateur n'a pas encore touché au champ, on quitte la fonction sans rien colorier en rouge.

```javascript
        if (error) {
            field.input.classList.remove("border-blue-200", "border-emerald-500", "dark:border-white/20", "dark:border-emerald-400", "focus:ring-2", "focus:ring-blue-500/20");
            field.input.classList.add("border-red-500", "dark:border-red-400", "focus:ring-2", "focus:ring-red-500/20");
            field.msg.textContent = error;
            field.msg.className = "mt-1.5 block text-xs font-medium text-red-500 dark:text-red-400";
            return false;
```
* **Si erreur :** On retire les couleurs bleues et vertes de base. On ajoute la couleur **Rouge** (`border-red-500`) sur la bordure de la case. On écrit le texte de l'erreur dans la zone de message en rouge. On renvoie `false` (champ non valide).

```javascript
        } else {
            field.input.classList.remove("border-blue-200", "border-red-500", "dark:border-white/20", "dark:border-red-400", "focus:ring-2", "focus:ring-red-500/20");
            field.input.classList.add("border-emerald-500", "dark:border-emerald-400", "focus:ring-2", "focus:ring-emerald-500/20");
            field.msg.textContent = "✓ Valide";
            field.msg.className = "mt-1.5 block text-xs font-medium text-emerald-600 dark:text-emerald-400";
            return true;
        }
    }
```
* **Si tout est bon :** On retire le rouge. On ajoute la couleur **Émeraude/Verte** (`border-emerald-500`). On écrit un joli message "✓ Valide" en vert. On renvoie `true` (champ valide).

---

## 8. Vérification globale et activation du bouton d'envoi

Cette fonction vérifie l'ensemble du formulaire pour décider si on autorise l'envoi ou non.

```javascript
    function checkFormValidity() {
        let isValid = true;
        Object.keys(fields).forEach(key => {
            if (fields[key].validate(fields[key].input.value) !== null) {
                isValid = false;
            }
        });
```
* **`isValid = true`** : On imagine au départ que tout le formulaire est parfait.
* **`Object.keys(fields).forEach(...)`** : On fait le tour de tous les champs. Si un seul d'entre eux renvoie une erreur (donc pas `null`), alors `isValid` devient `false` (le formulaire n'est plus valide).

```javascript
        if (isValid) {
            submitBtn.disabled = false;
            submitBtn.className = "font-inter inline-flex cursor-pointer items-center gap-2 rounded-xl bg-blue-950 px-5 py-3 text-sm font-semibold text-white shadow-lg transition-transform hover:-translate-y-1 hover:bg-blue-900 dark:bg-violet-300 dark:text-blue-950 dark:hover:bg-violet-200 opacity-100";
        } else {
            submitBtn.disabled = true;
            submitBtn.className = "font-inter inline-flex cursor-not-allowed items-center gap-2 rounded-xl bg-slate-300 px-5 py-3 text-sm font-semibold text-slate-500 opacity-60 transition-all dark:bg-slate-700 dark:text-slate-400";
        }
    }
```
* **Si valide :** On débloque le bouton (`disabled = false`) et on lui applique un joli style bleu foncé (`bg-blue-950`) interactif qui monte d'un pixel au survol (`hover:-translate-y-1`).
* **Si invalide :** On bloque le bouton (`disabled = true`), la souris devient une icône d'interdiction (`cursor-not-allowed`) et le bouton devient gris et transparent (`bg-slate-300`, `opacity-60`).

---

## 9. Écoute des actions de l'utilisateur (Événements)

C'est ici qu'on branche le système de surveillance en temps réel sur les cases du formulaire.

```javascript
    Object.keys(fields).forEach(key => {
        const input = fields[key].input;
        const events = (input.type === "file" || input.tagName === "SELECT") ? ["change"] : ["input", "blur"];
```
* On regarde chaque case du formulaire une par une.
* **`events = ...`** : C'est une sécurité intelligente.
  * Si la case sert à mettre un fichier (`type === "file"`) ou si c'est une liste déroulante (`SELECT`), on écoute l'événement **`"change"`** (quand l'élément change de valeur).
  * Pour les zones de texte normales (nom, email...), on écoute **`"input"`** (quand l'utilisateur tape une lettre) et **`"blur"`** (quand l'utilisateur clique en dehors de la case).

```javascript
        events.forEach(evt => {
            input.addEventListener(evt, () => {
                touched[key] = true;
                updateFieldState(key);
                checkFormValidity();
            });
        });
    });
});
```
* Pour chaque événement retenu, dès qu'il se produit :
  1. On marque la case comme **touchée** (`touched[key] = true`).
  2. On met à jour l'affichage visuel (vert ou rouge) de cette case.
  3. On vérifie tout le formulaire pour savoir s'il faut allumer ou éteindre le bouton d'envoi.

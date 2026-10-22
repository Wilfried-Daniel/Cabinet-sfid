const testimonials = [
  {
    rating: 5,
    quote: "Travailler avec cette la SFID a complètement changé notre façon de gérer les impôts. Ils ont trouvé des déductions que nous ne connaissions pas et nous ont aidés à rester organisés toute l'année. C'est la première fois que la saison fiscale n'est pas stressante.",
    name: "Yasmine Koné",
    role: "Fondatrice, Garba & Co.",
    avatar: "https://randomuser.me/api/portraits/women/36.jpg",
    image: "https://images.unsplash.com/photo-1616587226960-4a03badbe8bf?auto=format&fit=crop&w=800&q=80"
  },
  {
    rating: 5,
    quote: "Un accompagnement au top du début à la fin. L'équipe est réactive, précise et nous fait gagner un temps précieux chaque trimestre.",
    name: "Amira Diallo",
    role: "Directrice, Diallo Consulting",
    avatar: "https://randomuser.me/api/portraits/women/30.jpg",
    image: "https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80"
  },
  {
    rating: 5,
    quote: "Grâce à leurs assistances, nous avons établi et déposés nos états financiers et notes annexes dans les délais prévus par la direction des impôts.",
    name: "Marc Lefèvre",
    role: "PDG, Lefèvre Industries",
    avatar: "https://randomuser.me/api/portraits/men/2.jpg",
    image: "https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80"
  },
  {
    rating: 5,
    quote: "L'accompagnement stratégique de l'équipe a transformé notre gestion financière. Grâce à leurs conseils avisés et leur vision à long terme, nous avons non seulement optimisé notre trésorerie au quotidien, mais aussi anticipé sereinement nos charges fiscales sans aucune mauvaise surprise en fin d'année.",
    name: "Josué Coulibaly",
    role: "Comptable, Kafka Sarl",
    avatar: "https://randomuser.me/api/portraits/men/16.jpg",
    image: "https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80"
  },
  {
    rating: 5,
    quote: "Une expertise comptable et fiscale d'une valeur inestimable pour notre croissance. Leurs recommandations sur mesure nous ont permis de restructurer nos flux financiers efficacement, de stabiliser notre trésorerie et d'éliminer les risques fiscaux liés à notre expansion à l'international.",
    name: "Henoc Yao",
    role: "CEO, HYao BTP Sarl",
    avatar: "https://randomuser.me/api/portraits/men/25.jpg",
    image: "https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80"
  }
];

let currentIndex = 0;
let timer = null;
const DELAY = 10000; // Délai en ms (5000 = 5s, changez à 10000 pour 10s)

// Références aux éléments fixes du HTML
const ratingEl = document.getElementById('rating');
const quoteEl = document.getElementById('quote');
const avatarEl = document.getElementById('avatar');
const nameEl = document.getElementById('author-name');
const roleEl = document.getElementById('author-role');
const imageEl = document.getElementById('testimonial-image');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

const starSVG = `<svg class="w-4 h-4 text-orange-400 fill-orange-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>`;

function renderTestimonial(index) {
  const t = testimonials[index];

  // Étoiles
  ratingEl.innerHTML = starSVG.repeat(t.rating);

  // Fondu texte + image
  quoteEl.style.opacity = 0;
  imageEl.style.opacity = 0;

  setTimeout(() => {
    quoteEl.textContent = t.quote;
    avatarEl.src = t.avatar;
    avatarEl.alt = t.name;
    nameEl.textContent = t.name;
    roleEl.textContent = t.role;
    imageEl.src = t.image;
    imageEl.alt = `Photo illustrant le témoignage de ${t.name}`;

    quoteEl.style.opacity = 1;
    imageEl.style.opacity = 1;
  }, 200);
}

// Transitions CSS
quoteEl.style.transition = 'opacity 0.3s ease-in-out';
imageEl.style.transition = 'opacity 0.3s ease-in-out';

function nextSlide() {
  currentIndex = (currentIndex + 1) % testimonials.length;
  renderTestimonial(currentIndex);
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
  renderTestimonial(currentIndex);
}

// Gestion du minuteur automatique
function startAutoPlay() {
  stopAutoPlay();
  timer = setInterval(nextSlide, DELAY);
}

function stopAutoPlay() {
  if (timer) clearInterval(timer);
}

// Événements boutons (remettent à zéro le compteur de 5s)
prevBtn.addEventListener('click', () => {
  prevSlide();
  startAutoPlay();
});

nextBtn.addEventListener('click', () => {
  nextSlide();
  startAutoPlay();
});

// Initialisation
renderTestimonial(currentIndex);
startAutoPlay();
const video = document.getElementById('myVideo');

video.addEventListener('play', () => {
    video.style.width = '640px'; // Ajusta el ancho según tus preferencias
    video.style.height = 'auto'; // Mantiene la proporción del video
});

video.addEventListener('pause', () => {
    video.style.width = '320px';
    video.style.height = '240px';
});


///
const historicalChallenges = [
    {
      era: "Mesopotamia",
      period: "4000 AC - Mesopotamia",
      title: "Los Sumerios",
      description: "¿Cuál fue uno de los inventos más importantes de la civilización sumeria?",
      context: "Los sumerios desarrollaron uno de los primeros sistemas de escritura conocidos.",
      options: ["La escritura cuneiforme", "La brújula", "El telescopio", "La pólvora"],
      answer: 0,
      explanation: "La escritura cuneiforme fue uno de los primeros sistemas de escritura de la humanidad, desarrollado por los sumerios alrededor del 3200 AC. Este sistema revolucionó la comunicación y permitió registrar la historia, las leyes y el comercio.",
      image: "linear-gradient(45deg, #8B4513, #A0522D)"
    },
    {
      era: "Antigua",
      period: "3000 AC - Antiguo Egipto",
      title: "Los Faraones del Antiguo Egipto",
      description: "¿Quién fue el faraón responsable de la construcción de la Gran Pirámide de Guiza?",
      context: "Las pirámides fueron construidas como tumbas monumentales para los faraones.",
      options: ["Keops", "Tutankamón", "Ramsés II", "Cleopatra"],
      answer: 0,
      explanation: "Keops (también conocido como Jufu) ordenó la construcción de la Gran Pirámide de Guiza alrededor del 2560 AC. Es la única de las Siete Maravillas del Mundo Antiguo que aún existe."
    },

    {
      era: "Clásica",
      period: "500 AC - Antigua Grecia",
      title: "Filosofía Griega",
      description: "¿Quién fue el maestro de Alejandro Magno?",
      context: "La educación era muy valorada en la antigua Grecia, especialmente para la realeza.",
      options: ["Sócrates", "Aristóteles", "Platón", "Pitágoras"],
      answer: 1,
      explanation: "Aristóteles fue el maestro de Alejandro Magno, y su influencia en la vida intelectual de Alejandro fue significativa."
    },
    {
        era: "Antigua Grecia",
        period: "480 AC - Guerras Médicas",
        title: "Batalla de las Termópilas",
        description: "¿Qué rey espartano lideró la defensa en las Termópilas?",
        context: "La batalla de las Termópilas fue un momento crucial en las Guerras Médicas.",
        options: ["Pericles", "Leónidas", "Temístocles", "Alejandro"],
        answer: 1,
        explanation: "El rey Leónidas de Esparta lideró a los 300 espartanos en la famosa batalla de las Termópilas."
      },
      {
        era: "Imperio Romano",
        period: "44 AC",
        title: "Fin de la República Romana",
        description: "¿Quién fue asesinado en los idus de marzo?",
        context: "Este evento marcó un punto de inflexión en la historia de Roma.",
        options: ["Augusto", "Julio César", "Marco Antonio", "Pompeyo"],
        answer: 1,
        explanation: "Julio César fue asesinado en los idus de marzo (15 de marzo) del año 44 AC por un grupo de senadores."
      },
      {
        era: "Era Vikinga",
        period: "793 DC - Era Vikinga",
        title: "Expansión Vikinga",
        description: "¿Qué explorador vikingo es considerado el primer europeo en llegar a América del Norte?",
        context: "Los vikingos fueron grandes navegantes y exploradores.",
        options: ["Erik el Rojo", "Leif Erikson", "Harald el de los Dientes Azules", "Ragnar Lothbrok"],
        answer: 1,
        explanation: "Leif Erikson llegó a América del Norte alrededor del año 1000 DC, estableciendo un asentamiento en L'Anse aux Meadows."
      },
    {
      era: "Medieval",
      period: "800 DC - Edad Media",
      title: "Imperio Carolingio",
      description: "¿Quién fue coronado como el primer Emperador del Sacro Imperio Romano?",
      context: "El Imperio Carolingio marcó el renacimiento del Imperio Romano en Occidente.",
      options: ["Pipino el Breve", "Carlomagno", "Luis el Piadoso", "Carlos Martel"],
      answer: 1,
      explanation: "Carlomagno fue coronado como emperador en el año 800 DC, consolidando gran parte de Europa Occidental bajo su control."
    },
    {
      era: "Renacimiento",
      period: "1500 DC - Renacimiento",
      title: "Arte del Renacimiento",
      description: "¿Quién pintó la Mona Lisa?",
      context: "El Renacimiento fue una época de gran desarrollo artístico y cultural.",
      options: ["Leonardo da Vinci", "Miguel Ángel", "Rafael", "Botticelli"],
      answer: 0,
      explanation: "La Mona Lisa fue pintada por Leonardo da Vinci, quien es considerado uno de los más grandes artistas del Renacimiento."
    },

   
      {
        era: "Edad Moderna",
        period: "1492 DC",
        title: "Descubrimiento de América",
        description: "¿Qué reyes católicos financiaron el viaje de Colón?",
        context: "El viaje de Colón cambió el curso de la historia mundial.",
        options: ["Fernando e Isabel", "Carlos I y Juana", "Felipe II y María Tudor", "Juan II y Catalina"],
        answer: 0,
        explanation: "Los Reyes Católicos, Fernando de Aragón e Isabel de Castilla, financiaron la expedición de Cristóbal Colón."
      },
      {
        era: "Revolución Industrial",
        period: "1769 DC",
        title: "Innovación Industrial",
        description: "¿Quién patentó la primera máquina de vapor efectiva?",
        context: "La máquina de vapor fue crucial para la Revolución Industrial.",
        options: ["Thomas Edison", "James Watt", "George Stephenson", "Robert Fulton"],
        answer: 1,
        explanation: "James Watt patentó su versión mejorada de la máquina de vapor en 1769, revolucionando la industria."
      },
      {
        era: "Era Napoleónica",
        period: "1815 DC",
        title: "Fin del Imperio Napoleónico",
        description: "¿En qué batalla fue definitivamente derrotado Napoleón?",
        context: "Esta batalla marcó el fin de las Guerras Napoleónicas.",
        options: ["Austerlitz", "Leipzig", "Waterloo", "Borodino"],
        answer: 2,
        explanation: "Napoleón fue definitivamente derrotado en la Batalla de Waterloo en 1815."
      },
      {
        era: "Siglo XIX",
        period: "1800s - Impresionismo",
        title: "Pintores Impresionistas",
        description: "¿Quién pintó 'Impresión, sol naciente', obra que dio nombre al movimiento impresionista?",
        context: "El impresionismo revolucionó la pintura con su nuevo enfoque de la luz y el color.",
        options: ["Claude Monet", "Edgar Degas", "Pierre-Auguste Renoir", "Paul Cézanne"],
        answer: 0,
        explanation: "Claude Monet pintó 'Impresión, sol naciente' en 1872, y su técnica rompió con las tradiciones anteriores de la pintura."
      },
      {
        era: "Siglo XX",
        period: "1900s - Arte Moderno",
        title: "Vanguardias Artísticas",
        description: "¿Quién pintó 'Guernica'?",
        context: "El arte del siglo XX estuvo marcado por las guerras mundiales y las vanguardias.",
        options: ["Pablo Picasso", "Salvador Dalí", "Vincent van Gogh", "Henri Matisse"],
        answer: 0,
        explanation: "'Guernica' es una obra de Pablo Picasso que representa el bombardeo de la ciudad de Guernica durante la Guerra Civil Española."
      },
      {
        era: "Segunda Guerra Mundial",
        period: "1945 DC",
        title: "Fin de la Guerra",
        description: "¿Sobre qué ciudades japonesas se lanzaron bombas atómicas?",
        context: "Estos eventos llevaron a la rendición de Japón.",
        options: ["Tokio y Osaka", "Hiroshima y Nagasaki", "Kioto y Yokohama", "Sapporo y Kobe"],
        answer: 1,
        explanation: "Las bombas atómicas fueron lanzadas sobre Hiroshima (6 de agosto) y Nagasaki (9 de agosto) en 1945."
      },
      {
        era: "Guerra Fría",
        period: "1961 DC",
        title: "División de Berlín",
        description: "¿En qué año se construyó el Muro de Berlín?",
        context: "El Muro de Berlín fue un símbolo de la Guerra Fría.",
        options: ["1945", "1955", "1961", "1968"],
        answer: 2,
        explanation: "La construcción del Muro de Berlín comenzó el 13 de agosto de 1961."
      },
  

    {
      era: "Contemporánea",
      period: "1950-2000 - Arte Contemporáneo",
      title: "Arte Pop",
      description: "¿Quién fue el máximo exponente del Pop Art?",
      context: "El Arte Pop revolucionó el mundo del arte usando imágenes de la cultura popular.",
      options: ["Andy Warhol", "Roy Lichtenstein", "Keith Haring", "Jackson Pollock"],
      answer: 0,
      explanation: "Andy Warhol es conocido como el principal exponente del Pop Art, famosa por su obra 'Lata de Sopa Campbell'."
    }
  ];
  
let currentChallenge = 0;
let progress = 0;

function updateChallenge() {
  const challenge = historicalChallenges[currentChallenge];
  document.getElementById('resultFeedback').className = 'result-feedback';
  document.getElementById('resultFeedback').textContent = '';

  if (!challenge) {
    document.querySelector('.challenge-box').innerHTML = `
      <h3>¡Felicitaciones! 🎉</h3>
      <p>Has completado tu viaje por la historia. ¡Eres un verdadero historiador!</p>
    `;
    checkBtn.style.display = 'none';
    return;
  }

  document.getElementById('levelDisplay').textContent = challenge.era;
  document.getElementById('levelBadge').textContent = `📚 Época ${challenge.era}`;
  document.getElementById('timePeriod').textContent = challenge.period;
  document.getElementById('challenge-title').textContent = challenge.title;
  document.getElementById('challenge-description').textContent = challenge.description;
  document.getElementById('historicalContext').textContent = challenge.context;

  const optionsContainer = document.getElementById('optionsContainer');
  optionsContainer.innerHTML = '';
  challenge.options.forEach((option, index) => {
    const button = document.createElement('button');
    button.className = 'option-btn';
    button.textContent = option;
    button.dataset.index = index;
    button.onclick = selectOption;
    optionsContainer.appendChild(button);
  });
}

function selectOption(e) {
  document.querySelectorAll('.option-btn').forEach(btn => btn.classList.remove('selected'));
  e.target.classList.add('selected');
}

function checkAnswer() {
  const selectedOption = document.querySelector('.option-btn.selected');
  const resultFeedback = document.getElementById('resultFeedback');
  
  if (!selectedOption) {
    feedback.textContent = "❗ Selecciona una respuesta";
    return;
  }

  const userAnswer = parseInt(selectedOption.dataset.index);
  const correctAnswer = historicalChallenges[currentChallenge].answer;
  const challenge = historicalChallenges[currentChallenge];

  if (userAnswer === correctAnswer) {
    feedback.textContent = "🎉";
    resultFeedback.textContent = challenge.explanation;
    resultFeedback.className = 'result-feedback correct';
    progress = ((currentChallenge + 1) / historicalChallenges.length) * 100;
    document.getElementById('progress').style.width = progress + '%';
    
    setTimeout(() => {
      currentChallenge++;
      updateChallenge();
      feedback.textContent = "🤔";
      resultFeedback.className = 'result-feedback';
      resultFeedback.textContent = '';
    }, 3000);
  } else {
    feedback.textContent = "❌";
    resultFeedback.textContent = "¡Intenta de nuevo! Revisa el contexto histórico para encontrar pistas.";
    resultFeedback.className = 'result-feedback incorrect';
    setTimeout(() => {
      feedback.textContent = "🤔";
      resultFeedback.className = 'result-feedback';
      resultFeedback.textContent = '';
    }, 2000);
  }
}

document.getElementById('checkBtn').addEventListener('click', checkAnswer);

updateChallenge();
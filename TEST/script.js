const testData = {
  "questions": [
    {
      "id": 1,
      "question": "What is the output of 2 + 2 in Python?",
      "options": ["2", "3", "4", "22"],
      "answer": "4"
    },
    {
      "id": 2,
      "question": "Which data type is mutable in Python?",
      "options": ["List", "Tuple", "String", "Integer"],
      "answer": "List"
    },
    {
      "id": 3,
      "question": "Which library is used for data manipulation in Python?",
      "options": ["Matplotlib", "Pandas", "Numpy", "Seaborn"],
      "answer": "Pandas"
    },
    {
      "id": 4,
      "question": "What does the 'len' function do in Python?",
      "options": ["Returns length", "Adds numbers", "Sorts list", "Finds index"],
      "answer": "Returns length"
    }
  ]
};

const quizContainer = document.getElementById('quiz-container');
const resultContainer = document.getElementById('result');

// Soruları dinamik olarak oluştur
testData.questions.forEach((question, index) => {
  const questionDiv = document.createElement('div');
  questionDiv.innerHTML = `
    <p>${index + 1}. ${question.question}</p>
    ${question.options.map((option, i) => `
      <label>
        <input type="radio" name="question-${index}" value="${option}">
        ${option}
      </label><br>
    `).join('')}
  `;
  quizContainer.appendChild(questionDiv);
});

// Formu gönderme olayını işle
document.getElementById('quiz-form').addEventListener('submit', function (e) {
  e.preventDefault();

  let score = 0;

  testData.questions.forEach((question, index) => {
    const selectedOption = document.querySelector(`input[name="question-${index}"]:checked`);
    if (selectedOption && selectedOption.value === question.answer) {
      score++;
    }
  });

  resultContainer.textContent = `You scored ${score} out of ${testData.questions.length}.`;
});

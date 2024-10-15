const feedbackBoxes = document.querySelectorAll('.feedback-box');
let currentFeedbackIndex = 0;

document.getElementById('next-btn').addEventListener('click', () => {
    feedbackBoxes[currentFeedbackIndex].style.display = 'none';
    currentFeedbackIndex = (currentFeedbackIndex + 1) % feedbackBoxes.length;
    feedbackBoxes[currentFeedbackIndex].style.display = 'block';
});

document.getElementById('prev-btn').addEventListener('click', () => {
    feedbackBoxes[currentFeedbackIndex].style.display = 'none';
    currentFeedbackIndex = (currentFeedbackIndex - 1 + feedbackBoxes.length) % feedbackBoxes.length;
    feedbackBoxes[currentFeedbackIndex].style.display = 'block';
});
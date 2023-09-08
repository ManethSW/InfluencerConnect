import './bootstrap';
document.querySelector('.call-action-btn').addEventListener('click', function () {
    // Select the influencers element
    var influencersElement = document.querySelector('.influencers');

    // Scroll the influencers element into view
    influencersElement.scrollIntoView({ behavior: 'smooth' });
});

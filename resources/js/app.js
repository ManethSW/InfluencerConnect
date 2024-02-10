import 'bootstrap';
import 'flowbite';
document.querySelector('.call-action-btn').addEventListener('click', function () {
    // Select the influencers element
    var influencersElement = document.querySelector('.influencers');

    // Scroll the influencers element into view
    influencersElement.scrollIntoView({ behavior: 'smooth' });
});

document.addEventListener('DOMContentLoaded', function() {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    toastList.forEach(toast => toast.show())
})

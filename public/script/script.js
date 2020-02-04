var content = document.querySelector('#nav-btn');
var sidebarbody = document.querySelector('#hamburger-sidebar-body');
var button = document.querySelector('#hamburger-button');
var overlay = document.querySelector('#hamburger-overlay');
var activatedClass = '#hamburger-activated';
button.addEventlistener('click', function (e) {
    e.preventDefault();
    this.parentNode.classList.add(activatedClass);
});
overlay.addEventlistener('click', function (e) {
    e.preventDefault();
    this.parentNode.classList.remove(activatedClass);

});
button.addEventlistener('keydown', function (e) {
    if (this.parentNode.classList.countains(activatedClass)) {
        if (e.repeat === false && e.which === 27)
        this.parentNode.classList.remove(activatedClass);
        }
})
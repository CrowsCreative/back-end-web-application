const showPopup = document.querySelector('#show-password');
const url_image = document.querySelector('#url-image');
const popup_1 = document.querySelector('.popup-wrapper-1');
const popup_2 = document.querySelector('.popup-wrapper-2');

showPopup.addEventListener('click', () => {
    popup_1.classList.add('show');
});
url_image.addEventListener('click', () => {
    popup_2.classList.add('show');
});

popup_1.querySelector('.popup-close').addEventListener('click', () => {
    popup_1.classList.remove('show');
});
popup_2.querySelector('.popup-close').addEventListener('click', () => {
    popup_2.classList.remove('show');
});
